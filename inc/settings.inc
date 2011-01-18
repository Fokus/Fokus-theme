<?php

// Setup form
$fokus_options = array(
	array(
		"type" => "start-table"
	),
	array(
		"name" => "Primary theme color",
		"desc" => "Your themes primary color.",
		"id" => FOKUS_THEMENAME . "_theme_primary",
		"type" => "text",
		"std_value" => "E02802",
		"prefix" => "#"
	),
	array(
		"name" => "Secondary theme color",
		"desc" => "",
		"id" => FOKUS_THEMENAME . "_theme_secondary",
		"type" => "text",
		"std_value" => "FFDF12",
		"prefix" => "#"
	),
	array(
		"type" => "end-table"
	),
	array(
		"name" => "Primary menu colors",
		"type" => "title"
	),
	array(
		"type" => "start-table"
	),
	array(
		"name" => "Background inactive",
		"id" => FOKUS_THEMENAME . "_primary_menu_bg_inactive",
		"type" => "text",
		"std_value" => "000",
		"prefix" => "#"
	),
	array(
		"name" => "Color inactive",
		"id" => FOKUS_THEMENAME . "_primary_menu_color_inactive",
		"type" => "text",
		"std_value" => "DDD",
		"prefix" => "#"
	),
	array(
		"name" => "Background active",
		"id" => FOKUS_THEMENAME . "_primary_menu_bg_active",
		"type" => "text",
		"prefix" => "#",
		"suffix" => "*"
	),
	array(
		"name" => "Color active",
		"id" => FOKUS_THEMENAME . "_primary_menu_color_active",
		"type" => "text",
		"std_value" => "FFF",
		"prefix" => "#"
	),
	array(
		"name" => "Background hover",
		"id" => FOKUS_THEMENAME . "_primary_menu_bg_hover",
		"type" => "text",
		"std_value" => "444",
		"prefix" => "#"
	),
	array(
		"name" => "Color hover",
		"id" => FOKUS_THEMENAME . "_primary_menu_color_hover",
		"type" => "text",
		"std_value" => "DDD",
		"prefix" => "#"
	),
	array(
		"type" => "end-table"
	),
	array(
		"name" => "Secondary menu colors",
		"type" => "title"
	),
	array(
		"type" => "start-table"
	),
	array(
		"name" => "Background inactive",
		"id" => FOKUS_THEMENAME . "_secondary_menu_bg_inactive",
		"type" => "text",
		"std_value" => "CDCDCD",
		"prefix" => "#"
	),
	array(
		"name" => "Color inactive",
		"id" => FOKUS_THEMENAME . "_secondary_menu_color_inactive",
		"type" => "text",
		"std_value" => "000",
		"prefix" => "#"
	),
	array(
		"name" => "Background active",
		"id" => FOKUS_THEMENAME . "_secondary_menu_bg_active",
		"type" => "text",
		"prefix" => "#",
		"suffix" => "**"
	),
	array(
		"name" => "Color active",
		"id" => FOKUS_THEMENAME . "_secondary_menu_color_active",
		"type" => "text",
		"std_value" => "000",
		"prefix" => "#"
	),
	array(
		"name" => "Background hover",
		"id" => FOKUS_THEMENAME . "_secondary_menu_bg_hover",
		"type" => "text",
		"prefix" => "#"
	),
	array(
		"name" => "Color hover",
		"id" => FOKUS_THEMENAME . "_secondary_menu_color_hover",
		"type" => "text",
		"prefix" => "#",
		"suffix" => "*"
	),
	array(
		"type" => "end-table"
	),
	array(
		"type" => "paragraph",
		"value" => "* If no value is selected, the primary theme color will be used.<br />** If no value is selected, the secondary theme color will be used."
	)
);

// Create form function
function fokus_add_admin() {
	global $fokus_options;

	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {

			$values = array();
			foreach ($fokus_options as $value) {
				if ($value['id']) {
					$values[$value['id']] = $_REQUEST[$value['id']];
				}
			}

			update_option( FOKUS_THEMENAME . '_settings', $values );

		} else if( 'reset' == $_REQUEST['action'] ) {

			delete_option( FOKUS_THEMENAME . '_settings' );

			header("Location: themes.php?page=settings.inc&reset=true");
			die;

		}
	}


	add_theme_page( "Colors", "Colors", 'edit_themes', basename(__FILE__), 'fokus_admin' );
}

function fokus_admin() {
	global $fokus_options;

  if ( $_REQUEST['save'] ) echo '<div id="message" class="updated fade"><p><strong>' . __( 'Options saved.' ) . '</strong></p></div>';
  if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>' . __( 'Options restored.' ) . '</strong></p></div>';

	$settings = get_settings( FOKUS_THEMENAME . '_settings' );
?>

<div class="wrap">
<h2><?php echo ucfirst( FOKUS_THEMENAME ); ?> color settings</h2>

<form method="post" action="">

<?php foreach ($fokus_options as $value) {
switch ($value['type']) {

case "start-table":
?>
<table class="form-table">
	<tbody>
<?php
break;

case "end-table";
?>
	</tbody>
</table>
<?php
break;

case "title":
?>
<h3><?php echo __($value['name']); ?></h3>
<?php
break;

case 'paragraph':
?>
<p><?php echo $value['value']; ?></p>
<?php
break;

case 'text':
$set_value = $settings[$value['id']] ? $settings[$value['id']] : $value['std_value'];
$set_value = stripslashes($set_value);
?>
	<tr valign="top">
		<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
		<td>
			<?php if ($value['prefix']): ?><span class="prefix"><?php echo $value['prefix']; ?></span><?php endif; ?>
			<input size="<?php echo $value['size']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo $set_value; ?>" />
			<?php if ($value['suffix']): ?><span class="suffix"><?php echo $value['suffix']; ?></span><?php endif; ?>
			<?php if ($value['desc']): ?><span class="description"><?php echo $value['desc']; ?></span><?php endif; ?>
		</td>
	</tr>
<?php
break;

case 'textarea':
$set_value = $settings[$value['id']] ? $settings[$value['id']] : $value['std_value'];
$set_value = stripslashes($set_value);
?>
	<tr valign="top">
		<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
		<td>
			<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="40" rows="5"><?php echo $set_value; ?></textarea>
			<?php if ($value['desc']): ?><span class="description"><?php echo $value['desc']; ?></span><?php endif; ?>
		</td>
	</tr>
<?php
break;

case 'select':
?>
	<tr valign="top">
		<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
		<td>
			<select style="width:140px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['fokus_options'] as $key => $item) { ?>
<?php
	$selected = '';
	$saved = $settings[$value['id']];
	if ($saved && ($saved === $item)) {
		$selected = ' selected="selected"';
	} elseif (!$saved && ($saved === $item)) {
		$selected = ' selected="selected"';
	} elseif (!$saved && ($value['std_value'] === $item)) {
		$selected = ' selected="selected"';
	}
?>
			<option<?php echo " value=\"$item\"" . $selected; ?>><?php echo $key; ?></option>
<?php } ?>
			</select>
			<?php if ($value['desc']): ?><span class="description"><?php echo $value['desc']; ?></span><?php endif; ?>
		</td>
	</tr>
<?php
break;

case "checkbox":
$checked = $settings[$value['id']] ? 'checked="checked"' : '';
?>
	<tr valign="top">
		<th scope="row"><?php echo $value['name']; ?></th>
		<td>
			<label for="<?php echo $value['id']; ?>">
				<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="1" <?php echo $checked; ?> />
				<?php if ($value['desc']): ?><span class="description"><?php echo $value['desc']; ?></span><?php endif; ?>
			</label>
		</td>
	</tr>
<?php
break;
}
}
?>

<p class="submit">
<input class="button-primary" name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post" action="">
<p class="submit">
<input name="reset" type="submit" value="Reset default colors" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div>

<?php
}

add_action('admin_menu', 'fokus_add_admin');
?>
