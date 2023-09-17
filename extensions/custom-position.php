<?php
use \Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly.
class FBTH_Positioning
{
    /*
     * Instance of this class
     */
    private static $instance = null;
    public function __construct()
    {
        // Add new controls to advanced tab globally
        add_action("elementor/element/after_section_end", array($this, 'fbth_addons_add_position_controls_section'), 10, 3);
    }
    public function fbth_addons_add_position_controls_section($widget, $section_id, $args)
    {
        //Link to sections
        $target_sections = array('section_custom_css');
        if (!defined('ELEMENTOR_PRO_VERSION')) {
            $target_sections[] = 'section_custom_css_pro';
        }
        if (!in_array($section_id, $target_sections)) {
            return;
        }


        // Adds Positioning Options
        $widget->start_controls_section(
            'fbth_addons_section_advanced_position',
            array(
                'label' =>  __('Positioning', 'fbth'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            )
        );
        $widget->add_responsive_control(
            'fbth_addons_position_type',
            array(
                'label' => __('Position Type', 'fbth'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => __('Default', 'fbth'),
                    'static' => __('Static', 'fbth'),
                    'relative' => __('Relative', 'fbth'),
                    'absolute' => __('Absolute', 'fbth'),
                ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}}' => 'position:{{VALUE}};',
                ),
            )
        );
        $widget->add_responsive_control(
            'fbth_addons_position_top',
            array(
                'label' => __('Top', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'fbth_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $widget->add_responsive_control(
            'fbth_addons_position_right',
            array(
                'label' => __('Right', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'fbth_addons_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $widget->add_responsive_control(
            'fbth_addons_position_bottom',
            array(
                'label' => __('Bottom', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'fbth_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $widget->add_responsive_control(
            'fbth_addons_position_left',
            array(
                'label' => __('Left', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'fbth_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $widget->add_responsive_control(
            'fbth_addons_position_from_center',
            array(
                'label' => __('From Center', 'fbth'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'fbth_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $widget->add_responsive_control(
            'fbth_addons_position_zindex',
            array(
                'label' => __('Z-Index', 'fbth'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}}' => 'z-index:{{VALUE}};',
                ),
            )
        );
        $widget->end_controls_section();
    }
    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
FBTH_Positioning::get_instance();