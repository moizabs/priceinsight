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

        // const vehicleInfo = record.ymk ? record.ymk.split(' ') : ['', '', ''];
        // $('#pyear_check').val(vehicleInfo[0] || '').prop('readonly', true);
        // $('#pmake').val(vehicleInfo[1] || '').prop('readonly', true);
        // $('#pmodel').val(vehicleInfo[2] || '').prop('readonly', true);

        $('#pvehicle_type').val(record.type || '').prop('disabled', true);
        $('#pinoperable').prop('checked', record.condition == 2).prop('disabled', true);
        $('#ptrailer-type').val(record.transport || '').prop('disabled', true);
        // $(`input[name="ptrailer-type"][value="${record.transport || '1'}"]`).prop('checked', true);
        // $('input[name="ptrailer-type"]').prop('disabled', true);

        $('#pdispatch_price').val('').prop('readonly', false).focus();
        $('#plisted_price').val('').prop('readonly', false);

        $('#priceModal').modal('show');
    }

    async savePrice() {
        // 1st record
        const price = $('#pdispatch_price').val();
        const listed_price = $('#plisted_price').val();

        // 2nd record
        const porigin2 = $('#porigin2').val();
        const pdestination2 = $('#pdestination2').val();
        const pvehicle_type2 = $('#pvehicle_type2').val();
        const ptrailer_type2 = $('#ptrailer-type2').val();
        const pdispatch_price2 = $('#pdispatch_price2').val();
        const plisted_price2 = $('#plisted_price2').val();
        const pinoperable2 = $('#pinoperable2').is(':checked') ? 2 : 1;


        // 3rd record
        const porigin3 = $('#porigin3').val();
        const pdestination3 = $('#pdestination3').val();
        const pvehicle_type3 = $('#pvehicle_type3').val();
        const ptrailer_type3 = $('#ptrailer-type3').val();
        const pdispatch_price3 = $('#pdispatch_price3').val();
        const plisted_price3 = $('#plisted_price3').val();
        const pinoperable3 = $('#pinoperable3').is(':checked') ? 2 : 1;


        // 4th record
        const porigin4 = $('#porigin4').val();
        const pdestination4 = $('#pdestination4').val();
        const pvehicle_type4 = $('#pvehicle_type4').val();
        const ptrailer_type4 = $('#ptrailer-type4').val();
        const pdispatch_price4 = $('#pdispatch_price4').val();
        const plisted_price4 = $('#plisted_price4').val();
        const pinoperable4 = $('#pinoperable4').is(':checked') ? 2 : 1;


        // 5th record
        const porigin5 = $('#porigin2').val();
        const pdestination5 = $('#pdestination5').val();
        const pvehicle_type5 = $('#pvehicle_type5').val();
        const ptrailer_type5 = $('#ptrailer-type5').val();
        const pdispatch_price5 = $('#pdispatch_price5').val();
        const plisted_price5 = $('#plisted_price5').val();
        const pinoperable5 = $('#pinoperable5').is(':checked') ? 2 : 1;


        if (!price || !listed_price || !pdispatch_price2 || !plisted_price2 || !pdispatch_price3 || !plisted_price3
            || !pdispatch_price4 || !plisted_price4 || !pdispatch_price5 || !plisted_price5
        ) {
            alert('Please enter all prices');
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
                    listed_price: listed_price,

                    porigin2: porigin2,
                    pdestination2: pdestination2,
                    pvehicle_type2: pvehicle_type2,
                    ptrailer_type2: ptrailer_type2,
                    pdispatch_price2: pdispatch_price2,
                    plisted_price2: plisted_price2,
                    pinoperable2: pinoperable2,

                    porigin3: porigin3,
                    pdestination3: pdestination3,
                    pvehicle_type3: pvehicle_type3,
                    ptrailer_type3: ptrailer_type3,
                    pdispatch_price3: pdispatch_price3,
                    plisted_price3: plisted_price3,
                    pinoperable3: pinoperable3,

                    porigin4: porigin4,
                    pdestination4: pdestination4,
                    pvehicle_type4: pvehicle_type4,
                    ptrailer_type4: ptrailer_type4,
                    pdispatch_price4: pdispatch_price4,
                    plisted_price4: plisted_price4,
                    pinoperable4: pinoperable4,

                    porigin5: porigin5,
                    pdestination5: pdestination5,
                    pvehicle_type5: pvehicle_type5,
                    ptrailer_type5: ptrailer_type5,
                    pdispatch_price5: pdispatch_price5,
                    plisted_price5: plisted_price5,
                    pinoperable5: pinoperable5,

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