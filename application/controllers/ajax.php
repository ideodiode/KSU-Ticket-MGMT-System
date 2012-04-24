<?php

	class Ajax extends CI_Controller {

		function index() {
		}

		public function update() {
			$value = trim($_POST['value']);
			$table = trim($_POST['table']);
			$field = trim($_POST['field']);
			$row_id = trim($_POST['row_id']);
			$key = trim($_POST['key']);

			$model = $table . '_model';

			$this->load->model($model);

			$this->$model->update($key, $row_id, $field, $value);

			echo $value;
		}

		public function updateTime() {
			$value = trim($_POST['value']);
			$table = trim($_POST['table']);
			$field = trim($_POST['field']);
			$row_id = trim($_POST['row_id']);
			$key = trim($_POST['key']);

			$model = $table . '_model';

			$this->load->model($model);
			if ($value == true) {
				$time = time();
				$this->$model->update($key, $row_id, $field, date('Y-m-d H:i:s', 0));

				echo date('Y-m-d H:i:s', $time);
			} else {
				$this->$model->update($key, $row_id, $field, '0000-00-00 00:00:00');
				echo '0000-00-00 00:00:00';
			}

		}

	}
