<?php
// make sure the form request comes from WordPress
wp_nonce_field( 'wordpress-contributor', 'contributors_meta_box_nonce' );

$args = array( 
    'role_in'   => array( 'author', 'editor', 'admin' ),
    'exclude'   => array($post->post_author)
);
$users = get_users($args);

$contributors = get_post_meta( $post->ID, 'contributors', true );
$contributors_array = explode( ',' , $contributors );
?>
<div class="wrap">
<table>
<?php foreach( $users as $user ): ?>
    <tr>
        <td><input type="checkbox" name="contributors[]" value="<?php echo $user->ID; ?>" <?php echo ( in_array( $user->ID, $contributors_array ) )?( "checked" ):(""); ?>></td>
        <td><?php echo $user->display_name; ?></td>
    </tr>
<?php endforeach; ?>
</table>

</div>