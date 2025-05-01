<?php

namespace App\Enums;

enum CustomerEnum
{
    const MESSAGE_RETRIEVED_ALL = 'Customers retrieved successfully';
    const MESSAGE_RETRIEVED_ONE = 'Customer retrieved successfully';
    const MESSAGE_CREATED = 'Customer has been created successfully';
    const MESSAGE_UPDATED = 'Customer updated successfully';
    const MESSAGE_DELETED = 'Customer deleted successfully';
    const CUSTOMER_NOT_FOUND_MESSAGE = 'Customer not found';


}
