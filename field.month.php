<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PyroStreams Month Field Type
 *
 * @author		Laszlo Kovacs
 */
class Field_month
{
	public $field_type_slug			= 'month';
	public $db_col_type				= 'integer';
	public $version					= '1.0.0';
	public $author					= array('name' => 'Laszlo Kovacs', 'url' => 'http://xmeditor.hu');

	/**
	 * Output form input
	 *
	 * @param	array
	 * @param	array
	 * @return	string
	 */
	public function form_output($data, $entry_id, $field)
	{
		if(!empty($data['value'])) $current_month = $data['value'];
		else $current_month = null;
		return form_dropdown($data['form_slug'], $this->months($field->is_required), $current_month, 'id="'.$data['form_slug'].'"');
	}

	/**
	 * Pre Output for Plugin
	 * 
	 *
	 * @param	array
	 * @param	array
	 * @return	array
	 */
	public function pre_output_plugin($input, $data)
	{
		if (trim($input) != '' and in_array($input, range(1, 12)))
		{
			$return['value'] 	= date("F", mktime(0, 0, 0, $input+1, 0, 0));
			$return['key']	= $input;
			
			return $return;
		}
		else
		{
			return null;
		}
	}


	/**
	 * Month
	 *
	 * Returns an array of states
	 *
	 * @access	private
	 * @return	array
	 */
	private function months($is_required)
	{	
		$month_names=array();
		
		for ($i = 1; $i <= 12; $i++)
		{
			array_push($month_names,date("F", mktime(0, 0, 0, $i+1, 0, 0)));
		}		
		
		$months = array_combine($months = range(1, 12), $month_names);
		
		if ($is_required == 'no')
		{
			$months = array('' => '---')+$months;
		}
		  
		return $months;
	}
	
}