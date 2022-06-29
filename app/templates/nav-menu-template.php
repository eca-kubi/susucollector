<div class="container font-weight-bold fixed-top bg-secondary">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="<?php echo URLs::HOME ?>"><img class="img-fluid" src="<?php

            echo URL_ROOT ?>/public/img/favicon.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="<?php /** @var PageDTO $dto */
                echo $dto->pageId->value == PageIdsDTO::HOME ? 'active' : ''; ?> nav-item">
                    <a class="nav-link" href="<?php echo URLs::HOME ?>"><i class="fad fa-home-alt"></i> Home</a></li>
                <li class="<?php echo $dto->pageId->value == PageIdsDTO::CONTACT ? 'active' : ''; ?> nav-item"><a class="nav-link"
                            href="<?php echo URLs::CONTACTS ?>"><i class="fad fa-phone-alt"></i> Contacts</a></li>
                <li class="<?php echo $dto->pageId->value == PageIdsDTO::ADMIN_LOGIN ? 'active' : ''; ?> nav-item"><a class="nav-link"
                            href="<?php echo URLs::ADMINS_LOGIN ?>"><i class="fad fa-chart-pie-alt"></i> Admin</a></li>
                <li class="<?php echo $dto->pageId->value == PageIdsDTO::EMPLOYEE_LOGIN ? 'active' : ''; ?> nav-item"><a class="nav-link"
                            href="<?php echo URLs::AGENTS_LOGIN ?>"><i class="fa fa-user-chart"></i> Agent</a></li>
            </ul>
        </div>
    </nav>
</div>
