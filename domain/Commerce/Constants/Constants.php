<?php
namespace Domain\Commerce\Constants;

class Constants {
    Const STATUS_SUCCESS = "success";
    Const STATUS_SUCCESSFUL = "successful";
    Const STATUS_COMPLETED = "completed";
    Const STATUS_PENDING = "pending";
    Const STATUS_FAILED = "failed";
    Const STATUS_CANCELLED = "cancelled";
    Const STATUS_ENABLED = "enabled";
    Const STATUS_DISABLED = "disabled";
    Const CURRENCY_USD = "USD";

    Const ACTION_OTP = "provide_otp";
    Const ACTION_PIN = "provide_pin";
    Const ACTION_ADDRESS = "provide_address";
    Const ACTION_REDIRECT = "redirect";
    Const ACTION_TERMINATE = "terminate";
    Const ACTION_VERIFY_TRANSACTION = "verify_transaction";
    Const ACTION_REQUERY_TRANSACTION = "requery_transaction";
    Const ACTION_CLEAR_CART = "clear_cart";

}
