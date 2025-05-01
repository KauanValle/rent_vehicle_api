<?php

namespace App\Enums;

enum RentalEnum
{
    const MESSAGE_RETRIEVED_REPORT_REVENUE = 'Rentals report revenue retrieved successfully';
    const MESSAGE_RETRIEVED_ALL = 'Rentals retrieved successfully';
    const MESSAGE_RETRIEVED_ONE = 'Rental retrieved successfully';
    const MESSAGE_CREATED = 'Rental has been created successfully';
    const MESSAGE_START = 'Rental started has been successfully';
    const MESSAGE_END = 'Rental end has been successfully';
    const RENTAL_NOT_FOUND_MESSAGE = 'Rental not found';
    const RENTAL_NOT_STARTING_MESSAGE = 'Rental not started';
    const RENTAL_ALREADY_ENDED_MESSAGE = 'Rental has already been completed';
    const RENTAL_ALREADY_STARTED_MESSAGE = 'Rental has already been started';
}
