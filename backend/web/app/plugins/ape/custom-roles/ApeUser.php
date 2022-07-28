<?php

// Custom Role

function ape_create_apeuser_role()
{
    // capabilities for new role
    $capabilities = [
        'upload_files' => true,
        'read' => true,
        'remove_users'=> true
    ];

    //1:slug
    //2:display name
    //3: capability
    add_role('apeuser', 'APE Utilisateur', $capabilities);
}


function ape_remove_apeuser_role()
{
    // remove custom role    
    remove_role('apeuser');
}
