// function pricewithoutvs(){
//     var deposit = document.getElementById('veh_size_pass').value;

//     $.ajax({
//         type: "GET",
//         url: "/ajax/basicpriceoption.php",
//         data: "veh_size_pass=" + deposit,
//         success: function(html){
//             let timerInterval;
//             Swal.fire({
//                 title: 'Price Without a Vehicle Size!',
//                 html: 'Successfully Updated',
//                 type: 'success',
//                 timer: 2000,
//                 onBeforeOpen: () => {
//                     Swal.showLoading()
//                 },
//                 onClose: () => {
//                     clearInterval(timerInterval)
//                 }
//             }).then((result) => {
//                 if (
//                     // Read more about handling dismissals
//                     result.dismiss === Swal.DismissReason.timer
//                 ) {
//                     // console.log('I was closed by the timer')
//                 }
//             })
//         }
//     });
// }

// function disabledVehicle(){
//     var veh_op = document.getElementById('veh_op').value;
//     $.ajax({
//         type: "GET",
//         url: "/ajax/basicpriceoption.php",
//         data: "veh_op=" + veh_op,
//         success: function(html){
//             let timerInterval;
//             Swal.fire({
//                 title: 'Disabled Vehicles!',
//                 html: 'Successfully Updated',
//                 type: 'success',
//                 timer: 2000,
//                 onBeforeOpen: () => {
//                     Swal.showLoading()
//                 },
//                 onClose: () => {
//                     clearInterval(timerInterval)
//                 }
//             }).then((result) => {
//                 if (
//                     // Read more about handling dismissals
//                     result.dismiss === Swal.DismissReason.timer
//                 ) {
//                     // console.log('I was closed by the timer')
//                 }
//             })
//             return basicPricing();
//         }
//     });
// }

// function enclosedTransports(){
//     var enclosed = document.getElementById('enclosed').value;
//     $.ajax({
//         type: "POST",
//         url: "/ajax/basicpriceoption.php",
//         data: "enclosed=" + enclosed,
//         success: function(html){
//             let timerInterval;
//             Swal.fire({
//                 title: 'Enclosed Transports!',
//                 html: 'Successfully Updated',
//                 type: 'success',
//                 timer: 2000,
//                 onBeforeOpen: () => {
//                     Swal.showLoading()
//                 },
//                 onClose: () => {
//                     clearInterval(timerInterval)
//                 }
//             }).then((result) => {
//                 if (
//                     // Read more about handling dismissals
//                     result.dismiss === Swal.DismissReason.timer
//                 ) {
//                     // console.log('I was closed by the timer')
//                 }
//             })
//             return basicPricing();
//         }
//     });
// }

// function depositAmount(){
//     var deposit = document.getElementById('deposit').value;
//     var DepositHide = document.getElementById('DepositHide').options[document.getElementById('DepositHide').selectedIndex].value;
//     $.ajax({
//         type: "GET",
//         url: "/ajax/basicpriceoption.php",
//         data: "deposit=" + deposit +
//             "&DepositHide=" + DepositHide,
//         success: function(html){
//             let timerInterval;
//             Swal.fire({
//                 title: 'Deposit Settings!',
//                 html: 'Successfully Updated',
//                 type: 'success',
//                 timer: 2000,
//                 onBeforeOpen: () => {
//                     Swal.showLoading();
//                 },
//                 onClose: () => {
//                     clearInterval(timerInterval)
//                 }
//             }).then((result) => {
//                 if (
//                     // Read more about handling dismissals
//                     result.dismiss === Swal.DismissReason.timer
//                 ) {
//                     // console.log('I was closed by the timer')
//                 }
//             })
//             return basicPricing();
//         }
//     });
// }