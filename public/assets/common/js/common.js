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
