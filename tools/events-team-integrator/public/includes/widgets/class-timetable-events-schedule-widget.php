<?php
/*
Widget Name: timetable events schedule
Description: This widget is used to display information about events.
Settings:
 Title - Widget's text title
 Events count - Limit the events
 Columns number - Choose the number of columns
 Events order - Choose the events order
 Event title - Choose whether to display post title
 Event participants - Choose whether to display post participants
 Event schedule - Choose whether to display post schedule
*/

/**
 * Class Mti_Timetable_Events_Schedule_Widget.
 */
class Mti_Timetable_Events_Schedule_Widget extends Cherry_Abstract_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'mti-timetable-events-schedule';
		$this->widget_description = esc_html__( 'Display an information about selected user.', 'mti' );
		$this->widget_id          = 'mti-timetable-events-schedule';
		$this->widget_name        = esc_html__( 'Timetable Events Schedule', 'mti' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'value' => esc_html__( 'Timetable Events Schedule', 'mti' ),
				'label' => esc_html__( 'Title', 'mti' ),
			),
			'per_page' => array(
				'type'      => 'stepper',
				'value'     => 3,
				'max_value' => 50,
				'min_value' => 0,
				'label'     => esc_html__( 'Events count ( Set 0 to show all. )', 'mti' ),
			),
			'columns_number' => array(
				'type'       => 'stepper',
				'value'      => '3',
				'max_value'  => '4',
				'min_value'  => '1',
				'step_value' => '1',
				'label'      => esc_html__( 'Columns number', 'mti' ),
			),
			'order' => array(
				'type'    => 'radio',
				'value'   => 'DESC',
				'options' => array(
					'DESC' => array(
						'label' => esc_html__( 'DESC', 'mti' ),
						'slave' => 'DESC',
					),
					'ASC' => array(
						'label' => esc_html__( 'ASC', 'mti' ),
						'slave' => 'ASC',
					),
				),
				'label'   => esc_html__( 'Choose taxonomy type', 'monstroid2' ),
			),
			'show_title' => array(
				'type'  => 'switcher',
				'value' => 'true',
				'style' => 'small',
				'label' => esc_html__( 'Display title', 'mti' ),
			),
			'excerpt_length' => array(
				'type'       => 'stepper',
				'value'      => '10',
				'max_value'  => '500',
				'min_value'  => '0',
				'step_value' => '1',
				'label'      => esc_html__( 'Excerpt words length ( Set 0 to hide excerpt. )', 'monstroid2' ),
			),
			'show_participants' => array(
				'type'  => 'switcher',
				'value' => 'true',
				'style' => 'small',
				'label' => esc_html__( 'Display participants', 'mti' ),
			),
			'show_schedule' => array(
				'type'  => 'switcher',
				'value' => 'true',
				'style' => 'small',
				'label' => esc_html__( 'Display schedule', 'mti' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Widget function.
	 *
	 * @see   WP_Widget
	 * @since 1.0.1
	 * @param array $args     Widget arguments.
	 * @param array $instance Instance.
	 */
	public function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		$this->setup_widget_data( $args, $instance );
		$this->widget_start( $args, $instance );

		events_team_integrator()->get_timetable_events_schedule( $instance );

		$this->widget_end( $args );
		$this->reset_widget_data();

		echo $this->cache_widget( $args, ob_get_clean() );
	}
}

add_action( 'widgets_init', 'mti_register_timetable_events_schedule_widget' );
/**
 * Register events schedule widget.
 */
function mti_register_timetable_events_schedule_widget() {
	register_widget( 'Mti_Timetable_Events_Schedule_Widget' );
}
