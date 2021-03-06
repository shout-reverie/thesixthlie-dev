<?php
/**
 * Name       : MW WP Form Field Submit Button
 * Description: 確認ボタンと送信ボタンを自動出力
 * Version    : 1.5.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : December 14, 2012
 * Modified   : January 2, 2015
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class MW_WP_Form_Field_Submit_Button extends MW_WP_Form_Abstract_Form_Field {

	/**
	 * $type
	 * フォームタグの種類 input|select|button|error|other
	 * @var string
	 */
	public $type = 'button';

	/**
	 * set_names
	 * shortcode_name、display_nameを定義。各子クラスで上書きする。
	 * @return array shortcode_name, display_name
	 */
	protected function set_names() {
		return array(
			'shortcode_name' => 'mwform_submitButton',
			'display_name'   => __( 'Confirm &amp; Submit', MWF_Config::DOMAIN ),
		);
	}

	/**
	 * set_defaults
	 * $this->defaultsを設定し返す
	 * @return array defaults
	 */
	protected function set_defaults() {
		return array(
			'name' => '',
			'confirm_value' => __( 'Confirm', MWF_Config::DOMAIN ),
			'submit_value'  => __( 'Send', MWF_Config::DOMAIN ),
		);
	}

	/**
	 * input_page
	 * 入力ページでのフォーム項目を返す
	 * @return string HTML
	 */
	protected function input_page() {
		if ( !empty( $this->atts['confirm_value'] ) ) {
			return $this->Form->submit( MWF_Config::CONFIRM_BUTTON, $this->atts['confirm_value'] );
		}
		return $this->Form->submit( $this->atts['name'], $this->atts['submit_value'] );
	}

	/**
	 * confirm_page
	 * 確認ページでのフォーム項目を返す
	 * @return string HTML
	 */
	protected function confirm_page() {
		return $this->Form->submit( $this->atts['name'], $this->atts['submit_value'] );
	}

	/**
	 * add_mwform_tag_generator
	 * フォームタグジェネレーター
	 */
	public function mwform_tag_generator_dialog( array $options = array() ) {
		?>
		<p>
			<strong>name</strong>
			<?php $name = $this->get_value_for_generator( 'name', $options ); ?>
			<input type="text" name="name" value="<?php echo esc_attr( $name ); ?>" />
		</p>
		<p>
			<strong><?php esc_html_e( 'String on the confirm button', MWF_Config::DOMAIN ); ?></strong>
			<?php $confirm_value = $this->get_value_for_generator( 'confirm_value', $options ); ?>
			<input type="text" name="confirm_value" value="<?php echo esc_attr( $confirm_value ); ?>" />
		</p>
		<p>
			<strong><?php esc_html_e( 'String on the submit button', MWF_Config::DOMAIN ); ?></strong>
			<?php $submit_value = $this->get_value_for_generator( 'submit_value', $options ); ?>
			<input type="text" name="submit_value" value="<?php echo esc_attr( $submit_value ); ?>" />
		</p>
		<?php
	}
}
