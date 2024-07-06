<div class="profile-images-content">
<?php if ( ! empty( $users ) ) : ?>
    <div class="profile-images-thumbnails">
        <?php foreach ( $users as $user ) : ?>
            <div class="profile-thumbnail">
                <?php echo get_avatar( $user->ID, isset($options['thumbnail_size']) ? $options['thumbnail_size'] : 96 ); ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="total-users">
        <p><?php printf( esc_html__( 'Total users: %d', 'profile-images' ), $total_users['total_users'] ); ?></p>
    </div>
<?php else : ?>
    <p><?php esc_html_e( 'No users found.', 'profile-images' ); ?></p>
<?php endif; ?>
</div>
