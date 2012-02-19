/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 19.02.12
 * Time: 3:14
 * To change this template use File | Settings | File Templates.
 */
var Common =
{
	helper_date:function(unix_timestamp)
	{
		// create a new javascript Date object based on the timestamp
		// multiplied by 1000 so that the argument is in milliseconds, not seconds
		var date = new Date(unix_timestamp*1000);
		var year = date.getFullYear();
		var month = date.getMonth();
		var day = date.getDay();
		// hours part from the timestamp
		var hours = date.getHours();
		// minutes part from the timestamp
		var minutes = date.getMinutes();
		// seconds part from the timestamp
		var seconds = date.getSeconds();

		// will display time in 10:30:23 format
		var formattedTime = day + ':' + month + ':' + year;
		return formattedTime;
	}
}