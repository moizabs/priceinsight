class GlobalPriceCheck {
    constructor() {
        this.checkInterval = null;
        this.currentRecord = null;
        this.initialize();
    }

    initialize() {
        this.checkInterval = setInterval(() => this.checkUnpricedRecords(), 3000);
        
        $('#priceModal').on('hidden.bs.modal', () => {
            this.showNextRecord();
        });
        
        $('#insertPrice').click(() => this.savePrice());
    }

    async checkUnpricedRecords() {
        try {
            const response = await fetch('/get-unpriced-record');
            const data = await response.json();

            if ($('#priceModal').hasClass('show')) {

                this.showNextRecord();
                $('#priceModal').modal('hide');

            } else {

                this.currentRecord = data.record;
                this.showRecordInModal(data.record);
                
            }
            
            // if (data.record && !$('#priceModal').hasClass('show')) {
            //     this.currentRecord = data.record;
            //     this.showRecordInModal(data.record);
            // }
        } catch (error) {
            console.error('Error checking unpriced records:', error);
        }
    }

    showRecordInModal(record) {
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
        $('#plisted_price').val('').prop('readonly', false).focus();
        
        $('#priceModal').modal('show');
    }

    async savePrice() {
        const price = $('#pdispatch_price').val();
        const listed_price = $('#plisted_price').val();
        
        if (!price && !listed_price) {
            alert('Please enter both price');
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
            } else {
                alert('Error saving price: ' + (result.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Error saving price:', error);
            alert('Failed to save price');
        }
    }

    showNextRecord() {
       
        this.checkUnpricedRecords();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new GlobalPriceCheck();
});