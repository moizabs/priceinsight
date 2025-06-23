// class GlobalPriceCheck {
//     constructor() {
//         this.checkInterval = null;
//         this.currentRecord = null;
//         this.initialize();
//     }

//     initialize() {
//         this.checkInterval = setInterval(() => this.checkUnpricedRecords(), 3000);
        
//         $('#priceModal').on('hidden.bs.modal', () => {
//             this.showNextRecord();
//         });
        
//         $('#insertPrice').click(() => this.savePrice());
//     }

//     async checkUnpricedRecords() {
//         try {
//             const response = await fetch('/get-unpriced-record');
//             const data = await response.json();
                        
//             if (data.record && !$('#priceModal').hasClass('show')) {
//                 this.currentRecord = data.record;
//                 this.showRecordInModal(data.record);
//             }
//         } catch (error) {
//             console.error('Error checking unpriced records:', error);
//         }
//     }

//     showRecordInModal(record) {
//         $('#porigin').val(record.originzsc).prop('readonly', true);
//         $('#pdestination').val(record.destinationzsc).prop('readonly', true);
        
//         const vehicleInfo = record.ymk ? record.ymk.split(' ') : ['', '', ''];
//         $('#pyear_check').val(vehicleInfo[0] || '').prop('readonly', true);
//         $('#pmake').val(vehicleInfo[1] || '').prop('readonly', true);
//         $('#pmodel').val(vehicleInfo[2] || '').prop('readonly', true);
        
//         $('#pvehicle_type').val(record.type || '').prop('disabled', true);
//         $('#pinoperable').val(record.condition || '').prop('disabled', true);
//         $(`input[name="ptrailer-type"][value="${record.transport || '1'}"]`).prop('checked', true);
//         $('input[name="ptrailer-type"]').prop('disabled', true);
        
//         $('#pdispatch_price').val('').prop('readonly', false).focus();
//         $('#plisted_price').val('').prop('readonly', false).focus();
        
//         $('#priceModal').modal('show');
//     }

//     async savePrice() {
//         const price = $('#pdispatch_price').val();
//         const listed_price = $('#plisted_price').val();
        
//         if (!price && !listed_price) {
//             alert('Please enter both price');
//             return;
//         }

//         try {
//             const response = await fetch('/save-record-price', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
//                 },
//                 body: JSON.stringify({
//                     record_id: this.currentRecord.id,
//                     price: price,
//                     listed_price: listed_price
//                 })
//             });
            
//             const result = await response.json();
            
//             if (result.success) {
//                 $('#priceModal').modal('hide');
//             } else {
//                 alert('Error saving price: ' + (result.message || 'Unknown error'));
//             }
//         } catch (error) {
//             console.error('Error saving price:', error);
//             alert('Failed to save price');
//         }
//     }

//     showNextRecord() {
       
//         this.checkUnpricedRecords();
//     }
// }

// document.addEventListener('DOMContentLoaded', () => {
//     new GlobalPriceCheck();
// });



class GlobalPriceCheck {
    constructor() {
        this.checkInterval = null;
        this.statusCheckInterval = null;
        this.currentRecord = null;
        this.pendingRecords = {};
        this.isProcessing = false;
        this.initialize();
    }

    initialize() {
        this.checkInterval = setInterval(() => {
            if (!this.isProcessing) {
                this.checkUnpricedRecords();
            }
        }, 3000);
        
        $('#acceptDeclineModal').on('hidden.bs.modal', () => {
            if (!this.isProcessing) {
                this.showNextRecord();
            }
        });
        
        $('#acceptBtn').click(() => this.acceptRecord());
        $('#declineBtn').click(() => this.declineRecord());
        $('#insertPrice').click(() => this.savePrice());
        
        $('#priceModal').on('show.bs.modal', () => {
            this.isProcessing = true;
            this.stopStatusChecking();
        });
        
        $('#priceModal').on('hidden.bs.modal', () => {
            this.isProcessing = false;
            this.showNextRecord();
        });
    }

    startStatusChecking() {
        this.stopStatusChecking();
        this.statusCheckInterval = setInterval(() => {
            if (this.currentRecord && $('#acceptDeclineModal').hasClass('show')) {
                this.checkRecordStatus();
            }
        }, 2000);
    }

    stopStatusChecking() {
        if (this.statusCheckInterval) {
            clearInterval(this.statusCheckInterval);
            this.statusCheckInterval = null;
        }
    }

    async checkRecordStatus() {
        try {
            const response = await fetch(`/check-record-status/${this.currentRecord.id}`);
            const data = await response.json();
            
            if (!data.is_available || data.is_priced) {
                this.stopStatusChecking();
                $('#acceptDeclineModal').modal('hide');
                delete this.pendingRecords[this.currentRecord.id];
                this.currentRecord = null;
                
                if (!data.is_available) {
                    setTimeout(() => {
                        alert('This record has been taken by another employee.');
                    }, 500);
                }
            }
        } catch (error) {
            console.error('Error checking record status:', error);
        }
    }

    async checkUnpricedRecords() {
        try {
            const response = await fetch('/get-unpriced-record');
            const data = await response.json();
            
            if (data.record && !this.pendingRecords[data.record.id] && !this.isProcessing) {
                this.currentRecord = data.record;
                this.showAcceptDeclineModal(data.record);
                
                this.pendingRecords[data.record.id] = {
                    status: 'pending',
                    timestamp: new Date().getTime()
                };
                
                // Start checking record status
                this.startStatusChecking();
            }
        } catch (error) {
            console.error('Error checking unpriced records:', error);
        }
    }

    showAcceptDeclineModal(record) {
        $('#record-id').text(record.id);
        $('#acceptDeclineModal').modal('show');
    }

    async acceptRecord() {
        this.isProcessing = true;
        this.stopStatusChecking();
        $('#acceptDeclineModal').modal('hide');
        
        const response = await fetch(`/check-record-availability/${this.currentRecord.id}`);
        const data = await response.json();
        
        if (data.available) {
            await fetch('/lock-record', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    record_id: this.currentRecord.id
                })
            });
            
            this.showRecordInModal(this.currentRecord);
        } else {
            alert('This record has already been taken by another employee.');
            this.isProcessing = false;
            this.showNextRecord();
        }
    }

    declineRecord() {
        this.stopStatusChecking();
        $('#acceptDeclineModal').modal('hide');
        this.pendingRecords[this.currentRecord.id].status = 'declined';
        this.isProcessing = false;
        this.showNextRecord();
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
        $('#plisted_price').val('').prop('readonly', false);
        
        $('#priceModal').modal('show');
    }

    async savePrice() {
        const price = $('#pdispatch_price').val();
        const listed_price = $('#plisted_price').val();
        
        if (!price || !listed_price) {
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
                delete this.pendingRecords[this.currentRecord.id];
                this.isProcessing = false;
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
        if (!this.isProcessing) {
            this.checkUnpricedRecords();
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new GlobalPriceCheck();
});