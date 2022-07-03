<?php

enum TransactionType: string
{
    case WITHDRAWAL = 'withdrawal';
    case DEPOSIT = 'deposit';
}