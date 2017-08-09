<?php
include_once("./Services/Calendar/classes/class.ilAppointmentCustomModalPlugin.php");

/***
 * @author Jesús López Reyes <lopez@leifos.com>
 * @version $Id$
 *
 */
class ilCustomModalPlugin extends ilAppointmentCustomModalPlugin
{
	/**
	 * Get Plugin Name. Must be same as in class name il<Name>Plugin
	 * and must correspond to plugins subdirectory name.
	 *
	 * @return	string	Plugin Name
	 */
	final function getPluginName()
	{
		return "CustomModal";
	}

	/** example using the complete appointmentpresentationgui object as a param*/
	public function replaceContent()
	{
		$presentation = $this->getGUIObject();

		$appointment = $presentation->getAppointment();

		if($appointment['event']->isFullDay())
		{
			return "<div style='background-color: lightblue; border:3px solid red;padding:10px;'>
 					<p>---- [PLUGIN] extra content:<br> This event is FULL DAY!</p>
 					<img src='http://lorempixel.com/300/200/technics' alt=''>
 				</div>";
		}
		else
		{
			return "<div style='background-color: lightblue; border:1px solid blue;padding:10px;'>
 					<p>[PLUGIN] extra content: <br> This event is not full day.</p>
 					<img src='http://lorempixel.com/300/200/technics' alt=''>
 				</div>";
		}
	}

	/**
	 * example using the appointment array as a param
	 * @return string html content
	 */
	public function addExtraContent()
	{
		//$presentation = $this->getGUIObject();

		$appointment = $this->getAppointment();

		$cat_id = ilCalendarCategoryAssignments::_lookupCategory($appointment['event']->getEntryId());
		$cat = ilCalendarCategory::getInstanceByCategoryId($cat_id);

		if($cat->getType() == ilCalendarCategory::TYPE_OBJ)
		{
			$bgcolor = "#DAF0DF";
			$str = "This modal contains Object info";
		}
		else
		{
			$bgcolor = "#B5E4EE";
			$str = "This modal doesn't contain Object info";
		}

		return "<div style='background-color: $bgcolor; border:1px solid orange;padding:10px;'>
 					<h1>[PLUGIN] dynamic string: $str</h1>
 					<img src='http://lorempixel.com/400/200/technics' alt=''>
 				</div>";
	}

	/**
	 * @param ilInfoScreenGUI $a_info
	 * @return ilInfoScreenGUI
	 */
	public function infoscreenAddContent(ilInfoScreenGUI $a_info)
	{
		$a_info->addProperty("[PLUGIN] extra info", "[PLUGIN]This is the value of the property created by the plugin.");

		return $a_info;
	}


	/**
	 * @param ilToolbarGUI $a_toolbar
	 * @return ilToolbarGUI
	 */
	public function toolbarAddItems(ilToolbarGUI $a_toolbar)
	{
		$a_toolbar->addText("* [PLUGIN] added toolbar item  * ");
		return $a_toolbar;
	}

	/**
	 * @return ilToolbarGUI
	 */
	public function toolbarReplaceContent()
	{
		$toolbar = new ilToolbarGUI();
		$toolbar->addText("[PLUGIN] Toolbar replaced");
		return $toolbar;
	}
}
