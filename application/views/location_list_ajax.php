 <?php
				echo "<option value=''>Select</option>";
												if($location_list!=false)
												{
													foreach($location_list as $location)
													{
													  echo '<option value="'.$location->location_id.'">'.$location->location_name.'</option>';
													}
												}
											?>