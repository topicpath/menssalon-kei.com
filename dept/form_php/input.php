<?php
if(!isset($form_item)) exit;

foreach($form_item as $key => $val){
	$input = '';
	$attr = '';
	$input_arr = array();

	if($val['class']) {
		$attr .= ' class="' . $val['class'] . '"';
	}
	if($val['placeholder']) {
		$attr .= ' placeholder="' . $val['placeholder'] . '"';
	}

	if(is_array($val['attr'])) {
		foreach ($val['attr'] as $k => $v) {
			$attr .= ' ' . $k . '="' . $v . '"';
		}
	}

	if($val['type'] == "text" || $val['type'] == "tel" || $val['type'] == "number" || $val['type'] == "email") {
		$input = '<input type="'.$val['type'].'" name="'.$key.'" id="'.$key.'" value="'.($_SESSION['form'][$key] ? htmlspecialchars($_SESSION['form'][$key], ENT_QUOTES, 'UTF-8') : $val['default']).'"' . $attr . '>';
	}elseif($val['type'] == "hidden") {
		$value = $_SESSION['form'][$key] ? $_SESSION['form'][$key] : $val['default'];
		$value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
		$input = '<input type="'.$val['type'].'" name="'.$key.'" id="'.$key.'" value="'.$value.'"' . $attr . '>';
	}elseif($val['type'] == "textarea") {
		$value = $_SESSION['form'][$key] ? $_SESSION['form'][$key] : $val['default'];
		$value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
		$input = '<textarea name="'.$key.'" id="'.$key.'" rows="4" cols="40"' . $attr . '>'.$value.'</textarea>';
	}elseif($val['type'] == "checkbox") {
		$post_arr = is_array($_SESSION['form'][$key]) ? $_SESSION['form'][$key] : array($_SESSION['form'][$key]);
		if(!$_SESSION['form'][$key] && $val['default_checked']) $post_arr =  array($val['default_checked']);
		$i = 0;
		$input = '<ul>';
		foreach ($val['item'] as  $v) {
			$checked = in_array($v, $post_arr) ? ' checked="checked"' : '';
			$v_txt = $val['item_html'] ? $val['item_html'][$i] : $v;
			$input .= '<li><label for="'.$key.$i.'"><input type="checkbox" name="'.$key.'[]" value="'.$v.'" id="'.$key.$i.'"'.$checked.'><span class="check"></span>'.$v_txt.'</label></li>';
			$i ++;
		}
		$input .= '</ul>';
		if($val['has_other'] == true) {
			$other_label = $val['other_label'] ? $val['other_label'] : 'その他';
			$other_input_id = $key.'other_check';
			$other_class = $val['other_class'] ? $val['other_class'] : 'other';
			$checked = in_array($other_label, $post_arr) ? ' checked="checked"' : '';
			$other_checkbox_id = $key.'_other';
			$input .= '<div class="other_input"><label for="'.$other_input_id.'" class="' . $other_class . '"><input type="checkbox" name="'.$key.'[]" value="'.$other_label.'" id="'.$other_input_id.'" data-other-input="' . $other_checkbox_id . '"'.$checked.'><span class="check"></span>'.$other_label.'</label>';

			$disabled_class = $val['other_disabled_class'] ? $val['other_disabled_class'] : 'disabled';
			$disabled = '';
			if(!$checked) {
				$other_class .= ' ' . $disabled_class;
				$disabled = ' disabled';
			}
			$input .= '<input type="text" name="'.$other_checkbox_id.'" id="'.$other_checkbox_id.'" value="'.$_SESSION['form'][$other_checkbox_id].'" class="' . $other_class . '"' . $disabled . '></div>';
		}
	}elseif($val['type'] == "radio") {
		$is_vector = is_vector($val['item']);

		$input = '<ul>';
		foreach ($val['item'] as $k => $v) {
			$my_val = $is_vector ? $v : $k;
			$checked = $_SESSION['form'][$key] ? (($my_val == $_SESSION['form'][$key]) ? ' checked="checked"':'') : $my_val == $val['default_checked'] ? ' checked="checked"':'';
			$v_txt = $val['item_html'] ? $val['item_html'][$my_val] : $v;
			$input .= '<li><label><input type="radio" name="'.$key.'" value="'.$my_val.'"'.$checked.'><span class="check"></span>'.$v_txt.'</label></li>';
			$input_arr[$my_val] = '<label><input type="radio" name="'.$key.'" value="'.$my_val.'"'.$checked.'><span class="check"></span>'.$v_txt.'</label>';
			$i ++;
		}
		$input .= '</ul>';
		if($val['has_other'] == true) {
			$other_label = $val['other_label'] ? $val['other_label'] : 'その他';
			$other_input_id = $key.'other_check';
			$other_class = $val['other_class'] ? $val['other_class'] : 'has_other';
			$checked = $_SESSION['form'][$key] ? (($other_label == $_SESSION['form'][$key]) ? ' checked="checked"':'') : $other_label == $val['default_checked'] ? ' checked="checked"':'';
			$input .= '<div class="' . $other_class . '">';
			$input .= '<label for="'.$other_input_id.'"><input type="radio" name="'.$key.'" value="'.$other_label.'" id="'.$other_input_id.'"'.$checked.'><span class="check"></span>'.$other_label.'</label>';

			$disabled_class = $val['other_disabled_class'] ? $val['other_disabled_class'] : 'disabled';
			$disabled = '';
			if(!$checked) {
				$other_class .= ' ' . $disabled_class;
				$disabled = ' disabled';
			}
			$other_checkbox_id = $key.'_other';
			$input .= '<input type="text" name="'.$other_checkbox_id.'" id="'.$other_checkbox_id.'" value="'.$_SESSION['form'][$other_checkbox_id].'" class="' . $other_class . '"' . $disabled . '>';
			$input .= <<< EOT
<script>$('input[name={$key}]').on('change',function(){var ta=$('#{$other_checkbox_id}');if($('#{$other_input_id}').is(':checked')){ta.prop('disabled',false).removeClass('{$disabled_class}').focus();}else ta.prop('disabled',true).addClass('{$disabled_class}');});</script>
EOT;
			$input .= '</div>';
		}
	}elseif($val['type'] == "select") {
		$input = '<select name="'.$key.'"' . $attr . '>';
		if($val['default_val'] !== false) {
			$input .= '<option value="' . ($val['default_val'] ? $val['default_val'] : '') . '">' . ($val['default_text'] ? $val['default_text'] : '選択して下さい　') . '</option>';
		}
		foreach ($val['item'] as $v) {
			$selected = $_SESSION['form'][$key] ? (($v == $_SESSION['form'][$key]) ? ' selected="selected"':'') : $v == $val['default_checked'] ? ' selected="selected"':'';
			$input .= '<option value="'.$v.'"'.$selected.'>'.$v.'</option>';
		}
		$input .= '</select>';
	}

	if($val['prefix']) {
		$input = '<span class="prefix">' . $val['prefix'] . '</span>' . $input;
	}
	if($val['suffix']) {
		$input = $input . '<span class="suffix">' . $val['suffix'] . '</span>';
	}

	$form["$key"] = $input;
	$form_input_arr["$key"] = $input_arr;
}
