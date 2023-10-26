<?php
if (!defined('ABSPATH'))
    exit; ?>
<div class="post-content-wrap">
    <div class="post-thumbnail">
        <?php if (has_post_thumbnail()): ?>
            <div class="post-thumbnail-wrapper">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="post-link">
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                </a>
                <div class="post-top-meta post-category">
                    <?php
                    $category = get_the_category();
                    if ($category[0]) {
                        echo '<span><a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a></span>';
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="post-content">
        <?php if ($top_meta): ?>
            <div class="post-top-meta">
                <?php wp_kses_post($top_meta); ?>
            </div>
        <?php endif; ?>
        <?php printf('<a href="%s" ><h3 class="post-title">%s</h3></a>', esc_url(get_the_permalink()), esc_html($title));
        echo 'yes' == $settings['show_excerpt'] ? sprintf('<p> %s </p>', esc_html($excerpt)) : ''; ?>
        <?php if ($bottom_meta): ?>
            <div class="post-meta-bottom">
                <?php echo esc_html($bottom_meta); ?>
            </div>
        <?php endif; ?>
        <?php if ('yes' == $settings['show_readmore']): ?>
            <div class="post-btn-wrap">
                <a class='post-btn' href="<?php the_permalink() ?>">
                    <?php if ('before' == $settings['icon_position'] && !empty($settings['btn_icon']['value'])): ?>
                        <span class="icon-before btn-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']) ?>
                        </span>
                    <?php endif; ?>
                    <?php echo esc_html($settings['readmore_text']); ?>
                    <?php if ('after' == $settings['icon_position'] && !empty($settings['btn_icon']['value'])): ?>
                        <span class="icon-after btn-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']) ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>