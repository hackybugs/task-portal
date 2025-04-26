<?php

if (!isset($_SESSION['user_id'])) {
    redirect('?page=login');
}
