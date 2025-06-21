class GlobalPriceCheck {
    constructor() {
        this.checkInterval = null;
        this.priceUpdateInterval = null;
        this.currentRecord = null;
        this.lastRecordId = null;
        this.initialize();
    }

    initialize() {
        this.checkInterval = setInterval(() => this.checkUnpricedRecords(), 3000);
        
        this.priceUpdateInterval = setInterval(() => this.checkPriceUpdates(), 2000);
        
        $('#priceModal').on('hidden.bs.modal', () => {
            this.showNextRecord();
        });
        
        $('#insertPrice').click(() => this.savePrice());
    }

    async checkUnpricedRecords() {
        try {
            const response = await fetch('/get-unpriced-record');
            const data = await response.json();
            
            if (data.record) {
                // If we have a new record different from current one
                if (!this.currentRecord || this.currentRecord.id !== data.record.id) {
                    // Close modal if open (in case another session already priced it)
                    if ($('#priceModal').hasClass('show')) {
                        $('#priceModal').modal('hide');
                    }
                    
                    // Show new record
                    this.currentRecord = data.record;
                    this.lastRecordId = data.record.id;
                    this.showRecordInModal(data.record);
                }
            } else {
                $('#priceModal').modal('hide');
                this.showNextRecord();
            }
        } catch (error) {
            console.error('Error checking unpriced records:', error);
        }
    }

    async checkPriceUpdates() {
        if (!this.currentRecord) return;
        
        try {
            const response = await fetch(`/check-record-priced/${this.currentRecord.id}`);
            const data = await response.json();
            
            if (data.priced) {
                // If record was priced by someone else, close our modal
                if ($('#priceModal').hasClass('show')) {
                    $('#priceModal').modal('hide');
                }
                // Immediately check for next record
                this.showNextRecord();
            }
        } catch (error) {
            console.error('Error checking price updates:', error);
        }
    }

    showRecordInModal(record) {
        // Only show if we don't already have a modal open
        if ($('#priceModal').hasClass('show')) return;
        
        $('#porigin').val(record.originzsc).prop('readonly', true);
        $('#pdestination').val(record.destinationzsc).prop('readonly', true);
        
        const vehicleInfo = record.ymk ? record.ymk.split(' ') : ['', '', ''];
        $('#pyear_check').val(vehicleInfo[0] || '').prop('readonly', true);
        $('#pmake').val(vehicleInfo[1] || '').prop('readonly', true);
        $('#pmodel').val(vehicleInfo[2] || '').prop('readonly', true);
        
        $('#pvehicle_type').val(record.type || '').prop('disabled', true);
        $('#pinoperable').val(record.condition || '').prop('disabled', true);
        $(`input[name="ptrailer-type"][value="${record.transport || '1'}"]`).prop('checked', true);
        $('input[name="ptrailer-type"]').prop('disabled', true);
        
        $('#pdispatch_price').val('').prop('readonly', false).focus();
        $('#plisted_price').val('').prop('readonly', false);
        
        $('#priceModal').modal('show');
    }

    async savePrice() {
        const price = $('#pdispatch_price').val();
        const listed_price = $('#plisted_price').val();
        
        if (!price && !listed_price) {
            alert('Please enter both prices');
            return;
        }

        try {
            const response = await fetch('/save-record-price', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    record_id: this.currentRecord.id,
                    price: price,
                    listed_price: listed_price
                })
            });
            
            const result = await response.json();
            
            if (result.success) {
                $('#priceModal').modal('hide');
                // Immediately check for next record
                this.showNextRecord();
            } else {
                alert('Error saving price: ' + (result.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Error saving price:', error);
            alert('Failed to save price');
        }
    }

    showNextRecord() {
        this.currentRecord = null;
        this.checkUnpricedRecords();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new GlobalPriceCheck();
});