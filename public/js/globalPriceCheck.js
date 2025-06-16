class GlobalPriceCheck {
    constructor() {
        this.checkInterval = null;
        this.currentRecord = null;
        this.initialize();
    }

    initialize() {
        // Start checking every 2 seconds
        this.checkInterval = setInterval(() => this.checkUnpricedRecords(), 3000);
        
        // Set up modal event handlers
        $('#priceModal').on('hidden.bs.modal', () => {
            this.showNextRecord();
        });
        
        $('#insertPrice').click(() => this.savePrice());
    }

    async checkUnpricedRecords() {
        try {
            const response = await fetch('/get-unpriced-record');
            const data = await response.json();
            
            if (data.record && !$('#priceModal').hasClass('show')) {
                this.currentRecord = data.record;
                this.showRecordInModal(data.record);
            }
        } catch (error) {
            console.error('Error checking unpriced records:', error);
        }
    }

    showRecordInModal(record) {
        // Fill modal fields with record data (read-only except price)
        $('#porigin').val(record.originzsc).prop('readonly', true);
        $('#pdestination').val(record.destinationzsc).prop('readonly', true);
        
        // Extract year, make, model from ymk field if needed
        const vehicleInfo = record.ymk ? record.ymk.split(' ') : ['', '', ''];
        $('#pyear_check').val(vehicleInfo[0] || '').prop('readonly', true);
        $('#pmake').val(vehicleInfo[1] || '').prop('readonly', true);
        $('#pmodel').val(vehicleInfo[2] || '').prop('readonly', true);
        
        $('#pvehicle_type').val(record.type || '').prop('disabled', true);
        $('#pinoperable').val(record.condition || '').prop('disabled', true);
        $(`input[name="ptrailer-type"][value="${record.transport || '1'}"]`).prop('checked', true);
        $('input[name="ptrailer-type"]').prop('disabled', true);
        
        // Clear and focus price field
        $('#pdispatch_price').val('').prop('readonly', false).focus();
        
        // Show modal
        $('#priceModal').modal('show');
    }

    async savePrice() {
        const price = $('#pdispatch_price').val();
        
        if (!price) {
            alert('Please enter a price');
            return;
        }

        alert(this.currentRecord.id);
        alert(price);

        try {
            const response = await fetch('/save-record-price', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    record_id: this.currentRecord.id,
                    price: price
                })
            });
            
            const result = await response.json();
            
            if (result.success) {
                $('#priceModal').modal('hide');
            } else {
                alert('Error saving price: ' + (result.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Error saving price:', error);
            alert('Failed to save price');
        }
    }

    showNextRecord() {
        // Immediately check for next record
        this.checkUnpricedRecords();
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new GlobalPriceCheck();
});