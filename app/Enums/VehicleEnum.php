<?php

namespace App\Enums;

enum VehicleEnum
{
    const MESSAGE_RETRIEVED_ALL = 'Vehicles retrieved successfully';
    const MESSAGE_RETRIEVED_ONE = 'Vehicle retrieved successfully';
    const MESSAGE_CREATED = 'Vehicle has been created successfully';
    const MESSAGE_UPDATED = 'Vehicle updated successfully';
    const MESSAGE_DELETED = 'Vehicle deleted successfully';
    const VEHICLE_NOT_FOUND_MESSAGE = 'Vehicle not found';
}
