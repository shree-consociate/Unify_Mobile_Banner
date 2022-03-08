##################### STORETIME PLUGIN URL #####################

api URL :-
	1. POST :- 
		http://localhost/pluginsdevelopment/?rest_route=/storetime/v1/slot/update

	2. GET :- 
		http://localhost/pluginsdevelopment/?rest_route=/storetime/v1/slot/show&getData=


##################### STORETIME PLUGIN  DATA #####################

api JSON :-
	1. POST :-
			{
			    "data": 
			    {   
			        "store_toggle":"1", or "store_toggle":"0"
			        "slot_id":{ database slot_id },
			        "active_disable": "1" or "active_disable": "0"
			    }
			}

	 			======== OR ========

			{
			    "data": 
			    {   
			        "store_toggle":"1" or "store_toggle":"0"
			    }
			}

	 			======== OR ========


			{
			    "data": 
			    {   
			        "slot_id":{ database slot_id },
			        "active_disable": "1" or "active_disable": "0"
			    }
			}
