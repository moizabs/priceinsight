function basicPricing(usrObj){
    $.ajax({
        type: "GET",
        url: "/ajax/setbasicprice.php",
        data: {usrObj},
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").addClass('active');
            $("#pricePerMile").removeClass('active');
            $("#stateExceptions").removeClass('active');
            $("#vehicleSize").removeClass('active');
            $("#viewException").removeClass('active');
            $("#zipExceptions").removeClass('active');
            $("#sizeQueue").removeClass('active');
            $("#vehicleSizeSetting").removeClass('active');
            $("#lastActivity").removeClass('active');
        }
    });
}

function priceperMile(usrObj){
    $.ajax({
        type: "GET",
        url: "/ajax/price_per_mile.php",
        data: {usrObj},
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").removeClass('active');
            $("#pricePerMile").addClass('active');
            $("#stateExceptions").removeClass('active');
            $("#vehicleSize").removeClass('active');
            $("#viewException").removeClass('active');
            $("#zipExceptions").removeClass('active');
            $("#sizeQueue").removeClass('active');
            $("#vehicleSizeSetting").removeClass('active');
            $("#lastActivity").removeClass('active');
        }
    });
}

function viewExceptions(usrObj){
    $.ajax({
        type: "GET",
        url: "/ajax/view_exceptions.php",
        data: {usrObj},
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").removeClass('active');
            $("#pricePerMile").removeClass('active');
            $("#stateExceptions").removeClass('active');
            $("#vehicleSize").removeClass('active');
            $("#viewException").addClass('active');
            $("#zipExceptions").removeClass('active');
            $("#sizeQueue").removeClass('active');
            $("#vehicleSizeSetting").removeClass('active');
            $("#lastActivity").removeClass('active');
        }
    });
}

function vehicleSize(usrObj){
    $.ajax({
        type: "GET",
        url: "/ajax/vehicle_size.php",
        data: {usrObj},
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").removeClass('active');
            $("#pricePerMile").removeClass('active');
            $("#stateExceptions").removeClass('active');
            $("#vehicleSize").addClass('active');
            $("#viewException").removeClass('active');
            $("#zipExceptions").removeClass('active');
            $("#sizeQueue").removeClass('active');
            $("#vehicleSizeSetting").removeClass('active');
            $("#lastActivity").removeClass('active');
        }
    });
}

function zipcodeRules(usrObj){
    $.ajax({
        type: "GET",
        url: "/ajax/getziprules.php",
        data: {usrObj},
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").removeClass('active');
            $("#pricePerMile").removeClass('active');
            $("#stateExceptions").removeClass('active');
            $("#vehicleSize").removeClass('active');
            $("#viewException").removeClass('active');
            $("#zipExceptions").addClass('active');
            $("#sizeQueue").removeClass('active');
            $("#vehicleSizeSetting").removeClass('active');
            $("#lastActivity").removeClass('active');
        }
    });
}

function stateRules(usrObj){
    $.ajax({
        type: "GET",
        url: "/ajax/getrules.php",
        data: {usrObj},
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").removeClass('active');
            $("#pricePerMile").removeClass('active');
            $("#stateExceptions").addClass('active');
            $("#vehicleSize").removeClass('active');
            $("#viewException").removeClass('active');
            $("#zipExceptions").removeClass('active');
            $("#sizeQueue").removeClass('active');
            $("#vehicleSizeSetting").removeClass('active');
            $("#lastActivity").removeClass('active');
        }
    });
}

function vehiclesizeQueue(usrObj){
    $.ajax({
        type: "GET",
        url: "/ajax/vehicle_size_queue.php",
        data: {usrObj},
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").removeClass('active');
            $("#pricePerMile").removeClass('active');
            $("#stateExceptions").removeClass('active');
            $("#vehicleSize").removeClass('active');
            $("#viewException").removeClass('active');
            $("#zipExceptions").removeClass('active');
            $("#sizeQueue").addClass('active');
            $("#vehicleSizeSetting").removeClass('active');
            $("#lastActivity").removeClass('active');
        }
    });
}

function vehicleSizeSetting(usrObj){
    $.ajax({
        type: "GET",
        url: "/ajax/vehicle_size_setting.php",
        data: {usrObj},
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").removeClass('active');
            $("#pricePerMile").removeClass('active');
            $("#stateExceptions").removeClass('active');
            $("#vehicleSize").removeClass('active');
            $("#viewException").removeClass('active');
            $("#zipExceptions").removeClass('active');
            $("#sizeQueue").removeClass('active');
            $("#vehicleSizeSetting").addClass('active');
            $("#lastActivity").removeClass('active');
        }
    });
}

function lastActivity(usrObj){
    $.ajax({
        type: "GET",
        url: "/ajax/last_activity.php",
        data: {usrObj},
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").removeClass('active');
            $("#pricePerMile").removeClass('active');
            $("#stateExceptions").removeClass('active');
            $("#vehicleSize").removeClass('active');
            $("#viewException").removeClass('active');
            $("#zipExceptions").removeClass('active');
            $("#sizeQueue").removeClass('active');
            $("#vehicleSizeSetting").removeClass('active');
            $("#lastActivity").addClass('active');
        }
    });
}