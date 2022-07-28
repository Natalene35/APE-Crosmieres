<?php
function ape_create_apemember_role()
{
        // capabilities for new role
        get_role('editor')->capabilities;
        $capabilities = [
            'upload_files' => true,
            'read' => true,
            'remove_users'=> true
        ];
    add_role('apemember', 'APE Membre', get_role('editor')->capabilities);
}

function ape_remove_apemember_role()
{
    remove_role('apemember');
}
