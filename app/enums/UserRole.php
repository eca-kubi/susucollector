<?php
enum UserRole: string
{
    case ADMIN = 'admin';
    case AGENT = 'agent';
    case SUPER_ADMIN = 'super-admin';
    case CLIENT = 'client';
}