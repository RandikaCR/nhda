function typeUnd($val) {
    if (typeof ($val) == 'undefined' || typeof $val == 'undefined') {
        return false;
    }
    return true;
}

function log(data) {
    if (true) {
        console.log(data);
    }
}

function getDecimalValue($value, $defaultValue = 0, $decimalPoints = 2) {
    if (typeUnd($value)) {
        $value = ($value != null) ? $value.toString().replace(',', '') : $value;
        $value = Number($value);
        $spArr = $value.toString().split(".");
        if ($spArr.length > 0) {
            if (typeUnd($spArr[1])) {
                $decimalCount = $spArr[1].length;
                if (!Number.isNaN(parseInt($decimalCount)) && parseInt($decimalCount) < $decimalPoints) {
                    $decimalPoints = $decimalCount;
                }
            }
        }
        $value = parseFloat($value).toFixed($decimalPoints);
        if (!Number.isNaN(parseFloat($value))) {
            if (parseFloat($value) == parseInt($value)) {
                return Number(parseInt($value));
            } else {
                $addedVal = false;
                if (parseInt($value) == 0) {
                    $value = parseFloat($value) + 1;
                    $addedVal = true;
                }

                $power = (!Number.isNaN(parseFloat($decimalPoints))) ? Math.pow(10, parseFloat($decimalPoints)) : Math.pow(10, 2);
                $newVal = Math.ceil($value * $power) / $power;

                if ($addedVal) {
                    $newVal = parseFloat($newVal - 1).toFixed($decimalPoints);
                }

                return Number($newVal);
            }
        }
    }
    return $defaultValue;
}

function alertSuccess($message, $title = 'Success'){

    $alert = $('<div></div>').addClass('alert alert-success alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-0 mt-2').attr('role', 'alert')
        .append($('<i></i>').addClass('ri-check-double-line label-icon'))
        .append($('<strong></strong>').addClass('me-1').text($title))
        .append($('<span></span>').text($message))
        .append($('<button></button>').addClass('btn-close').attr('type', 'button').attr('data-bs-dismiss', 'alert').attr('aria-label', 'close'));

    return $alert;
}
function alertDanger($message, $title = 'Error'){

    $alert = $('<div></div>').addClass('alert alert-danger alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-0 mt-2').attr('role', 'alert')
        .append($('<i></i>').addClass('ri-error-warning-line label-icon'))
        .append($('<strong></strong>').addClass('me-1').text($title))
        .append($('<span></span>').text($message))
        .append($('<button></button>').addClass('btn-close').attr('type', 'button').attr('data-bs-dismiss', 'alert').attr('aria-label', 'close'));

    return $alert;
}

function alertProcessing($message = null, $title = 'Saving...'){

    if ($message == null || $message == ''){
        $message = '';
    }

    $alert = $('<div></div>').addClass('alert alert-info alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-0 mt-2').attr('role', 'alert')
        .append($('<span></span>').addClass('label-icon')
            .append($('<i></i>').addClass('ri-refresh-line icon-rotate-right'))
        )
        .append($('<strong></strong>').addClass('me-1').text($title))
        .append($('<span></span>').text($message))
        .append($('<button></button>').addClass('btn-close').attr('type', 'button').attr('data-bs-dismiss', 'alert').attr('aria-label', 'close'));

    return $alert;
}
