<?php
enum UserType: string
{
    const ADMIN = 'admin';
    //case NON_ADMIN = 'non-admin';
    const AGENT = 'agent';
    const SUPER_ADMIN = 'super-admin';
    const CLIENT = 'client';
}