<?php
class M_regreport extends CI_Model
{

	function get_report_reg()
	{
		$this->db->select('trx_registration.id_reg,trx_registration.reg_date,pat_data.pat_name,pat_data.pat_MRN,mst_client.client_name,id_service');
		$this->db->from('trx_registration');
		$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ', 'left');
		$this->db->order_by("trx_registration.reg_date", "desc");
		/* 	$this->db->limit(0,5); */
		$this->db->limit(1000);
		$query = $this->db->get();
		return $query;
	}

	public function report_reg_as_id($id_reg1 = null, $id_reg2 = null)
	{
		$this->db->select('
			trx_registration.id_reg,
			trx_registration.reg_date,
			pat_data.pat_name,
			pat_data.pat_MRN,
			mst_client.client_name,
			id_service
		');
		$this->db->from('trx_registration');
		$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ', 'left');
		if ($id_reg1 != null && $id_reg2 != null) {
			$this->db->where("id_reg BETWEEN $id_reg1 AND $id_reg2", NULL, TRUE);
		}

		$this->db->order_by("trx_registration.reg_date", "desc");
		$query = $this->db->get();
		return $query;
	}

	function report_expense_as_date($datereg1, $datereg2)
	{
		$this->db->select([
			'nama_barang',
			'nama_supplier',
			'qty',
			'harga',
			'biaya_tambahan',
			'sub_total',
			'created_at',
		]);
		$this->db->from('expense');
		$this->db->where("DATE(created_at) BETWEEN '$datereg1' AND '$datereg2'");
		$this->db->where('deleted_at', null);
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function report_expense_as_date_adam($datereg1, $datereg2)
	{
		$this->db->select('trx_item_po_h.id_po, trx_item_po_d.id_item_po_d, trx_item_po_h.created_date, trx_item_po_d.item_id, trx_item_po_d.item_qty, trx_item_po_h.supplier_id, trx_item_po_d.item_amount');
		$this->db->from('trx_item_po_h');
		$this->db->join('trx_item_po_d', 'trx_item_po_h.id_po=trx_item_po_d.id_po_header', 'left');
		$this->db->order_by('trx_item_po_h.created_date', 'desc');
		$this->db->where("trx_item_po_h.created_date BETWEEN '$datereg1' AND '$datereg2'");
		$query = $this->db->get();
		return $query;
	}

	function report_profit_as_date($datereg1, $datereg2)
	{
		$query = $this->db->query("SELECT * FROM 
			( 
				SELECT 
					`trx_registration`.`id_reg` AS id_trx, 
					`trx_registration`.`reg_date` AS tgl, 
					`serv_name` AS item_in, 
					'-' AS item_out, 
					`mst_service_price`.`Price`, 
					'-' AS ket,
					IF(`trx_pat_payment_d`.`type_payment` = 0, 'Cash',
						IF(`trx_pat_payment_d`.`type_payment` = 1, 'Credit Card',
							IF(`trx_pat_payment_d`.`type_payment` = 5, 'Debit Card', '-')
						)
					) AS type_payment
				FROM `trx_registration` 
				LEFT JOIN `pat_data` ON `trx_registration`.`id_pat` = `pat_data`.`id_pat` 
				LEFT JOIN `mst_client` ON `trx_registration`.`id_client` = `mst_client`.`id_Client` 
				LEFT JOIN `pat_order_h` ON `pat_order_h`.`id_reg` = `trx_registration`.`id_reg` 
				LEFT JOIN `pat_order_d` ON `pat_order_d`.`id_order_header` = `pat_order_h`.`id_order` 
				LEFT JOIN `mst_services` ON `mst_services`.`id_service` = `pat_order_d`.`id_service` 
				LEFT JOIN `mst_service_price` ON `mst_services`.`id_service` = `mst_service_price`.`id_service` 
				LEFT JOIN `trx_pat_payment_h` ON `trx_pat_payment_h`.`id_reg` = `trx_registration`.`id_reg`
				LEFT JOIN `trx_pat_payment_d` ON `trx_pat_payment_d`.`id_payment_header` = `trx_pat_payment_h`.`id_payment`
				WHERE 
					mst_service_price.price_type = 2 
					AND DATE(trx_registration.reg_date) BETWEEN '$datereg1' AND '$datereg2' 
				UNION ALL 
					SELECT 
						`trx_item_po_d`.`id_item_po_d`, 
						`trx_item_po_h`.`created_date`, 
						'-' AS item_in, 
						`trx_item_po_d`.`item_id`, 
						`trx_item_po_d`.`item_amount`, 
						'-' AS ket,
						'-' AS type_payment
					FROM `trx_item_po_h` 
					INNER JOIN `trx_item_po_d` ON `trx_item_po_h`.`id_po` = `trx_item_po_d`.`id_po_header` 
					WHERE DATE(trx_item_po_h.created_date) BETWEEN '$datereg1' AND '$datereg2'
				) A ORDER BY tgl DESC");
		return $query;
	}

	public function report_profit_as_date_adam($datereg1, $datereg2)
	{
		$query1 = $this->db
			->select('trx_registration.id_reg')
			->from('trx_registration')
			->where('status_reg', 3)
			->where('reg_date >=', $datereg1)
			->where('reg_date <=', $datereg2)
			->get();

		if ($query1->num_rows() == 0) {
			$arr_out = [];
		} else {
			$total = 0;
			$grand_total = 0;
			$result      = [];
			$arr_reg     = [];
			$a           = 0;

			foreach ($query1->result() as $key) {
				$arr_reg[$a] = $key->id_reg;
				$a++;
			}

			$query2 = $this->db
				->select([
					"date(trx_pat_payment_h.payment_date) as payment_date",
					"mst_services.serv_name as `out`",
					"trx_pat_payment_h.total_billing as `price_out`",
				])
				->from('pat_order_h')
				->join('trx_pat_payment_h', 'trx_pat_payment_h.id_reg = pat_order_h.id_reg', 'left')
				->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left')
				->join('mst_services', 'mst_services.id_service = pat_order_d.id_service', 'left')
				->where_in("pat_order_h.id_reg", $arr_reg)
				->get();

			foreach ($query2->result() as $key) {
				$total = $total + $key->price_out;
				$arr_out = [
					'date'      => $key->payment_date,
					'in'        => '',
					'out'       => $key->out,
					'price_in'  => '',
					'price_out' => $key->price_out,
					'total'     => $total,
				];

				array_push($result, $arr_out);
			}

			$query3 = $this->db
				->select([
					'date(expense.created_at) as payment_date',
					'expense.nama_barang as `in`',
					'expense.harga as `price_in`',
				])
				->from('expense')
				->where('expense.deleted_at', null)
				->where('expense.created_at >=', $datereg1)
				->where('expense.created_at <=', $datereg2)
				->get();

			foreach ($query3->result() as $key) {
				$total = $total - $key->price_in;
				$arr_out = [
					'date'      => $key->payment_date,
					'in'        => $key->in,
					'out'       => '',
					'price_in'  => $key->price_in,
					'price_out' => '',
					'total'     => $total,
				];

				array_push($result, $arr_out);
			}
		}

		$return = [
			'result' => $result,
			'total'  => $total,
		];

		return $return;
	}

	public function report_reg_as_date($datereg1 = null, $datereg2 = null)
	{
		$this->db->select('
			trx_registration.id_reg, 
			trx_registration.reg_date,
			pat_data.pat_name, 
			pat_data.pat_MRN, 
			mst_client.client_name, 
			mst_services.id_service, 
			serv_name, 
			mst_service_price.Price
		');
		$this->db->from('trx_registration');
		$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg ', 'left');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order ', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = pat_order_d.id_service ', 'left');
		$this->db->join('mst_service_price', 'mst_services.id_service = mst_service_price.id_service ', 'left');
		$this->db->where("mst_service_price.price_type=2");
		if ($datereg1 != null && $datereg2 != null) {
			$this->db->where("trx_registration.reg_date BETWEEN '$datereg1' AND '$datereg2'", null, false);
		}
		$this->db->order_by("id_reg", "desc");
		$query = $this->db->get();
		return $query;
	}


	public function report_reg_as_date_new($datereg1 = null, $datereg2 = null)
	{
		$this->db->select('trx_registration.id_reg,trx_registration.reg_date,pat_data.pat_name,pat_data.pat_MRN,mst_client.client_name,id_service');
		$this->db->from('trx_registration');
		$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ', 'left');

		if ($datereg1 != null && $datereg2 != null) {
			$this->db->where("trx_registration.reg_date BETWEEN '$datereg1' AND '$datereg2'", null, false);
		}

		$this->db->order_by("trx_registration.reg_date", "desc");
		$query = $this->db->get();
		return $query;
	}

	function get_trx_registration2($id_reg)
	{
		$this->db->where('trx_registration.id_reg', $id_reg);
		return $this->db->get('trx_registration'); //  load name of table
	}

	function del_trx_registration($id_reg)
	{
		$this->db->delete('trx_registration', array('id_reg' => $id_reg));
	}

	function update_registration($data_user, $id)
	{
		$this->db->where('id_reg', $id);
		$this->db->update('trx_registration', $data_user);
	}

	function get_patient_data_mark()
	{
		$this->db->select('*');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_pat',  'inner');
		$query = $this->db->get();
		return $query;
	}


	/* Select
  trx_registration.id_reg,
  trx_registration.reg_date,
  trx_registration.id_pat,
  pat_data.pat_MRN,
  pat_data.pat_name,
  pat_data.id_Pat As id_Pat1
From
  trx_registration Inner Join
  pat_data On trx_registration.id_pat = pat_data.id_Pat  */


	function get_trx_registration()
	{
		return $this->db->get('trx_registration'); //  load name of table
	}


	/* function save_registration($data_reg){
	$this->db->insert('trx_registration',$data_reg);
	}

		
	function get_mst_charge_rule(){
	return $this->db->get('mst_charge_rule'); //  load name of table
	}
		
	function get_mst_paytype(){
	return $this->db->get('mst_paytype'); //  load name of table
	}
	
	function get_mst_client(){
	return $this->db->get('mst_client'); //  load name of table
	}

	function get_mst_client_dept(){
	return $this->db->get('mst_client_dept'); //  load name of table
	}
	
	function get_mst_client_job(){
	return $this->db->get('mst_client_job'); //  load name of table
	}

	function get_mst_doctor(){
	return $this->db->get('mst_doctor'); //  load name of table
	}
	
	function get_mst_insurance(){
	return $this->db->get('mst_insurance'); //  load name of table
	}
	
	function get_mst_services(){
	return $this->db->get('mst_services'); //  load name of table
	}

	function get_mst_service_package_h(){
	return $this->db->get('mst_service_package_h'); //  load name of table
	}

	function get_mst_project(){
	$this->db->order_by("project_date_start", "desc");
	return $this->db->get('mst_project'); //  load name of table
	//$query = $this->db->get('mst_project'); 
	//return $query->result();
	}

	 */

	public function get_data_appointment()
	{
		return $this->db->select(
			[
				'pat_data.pat_name as patient_name',
				'trx_registration.reg_date as registration_date',
				'trx_registration.appointment_date',
				'trx_registration.appointment_time',
			]
		)
			->from('trx_registration')
			->join('pat_data', 'pat_data.id_Pat = trx_registration.id_pat', 'left')
			->where('trx_registration.status_reg', '0')
			->where('trx_registration.appointment_date !=', null)
			->where('trx_registration.appointment_time !=', null)
			->order_by('trx_registration.appointment_date', 'asc')
			->order_by('trx_registration.appointment_time', 'asc')
			->get();
	}

	public function get_list()
	{
		return $this->db
			->select([
				'trx_registration.id',
				'trx_registration.id_reg',
				'trx_registration.id_pat',
				'trx_registration.reg_date',
				'pat_data.pat_name',
				'mst_title.title_desc',
				'pat_data.pat_dob',
				'mst_price_type.price_type',
			])
			->from('trx_registration')
			->join('pat_data', 'pat_data.id_Pat = trx_registration.id_pat', 'left')
			->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left')
			->join('mst_price_type', 'mst_price_type.id_price_type = trx_registration.pat_charge_rule', 'left')
			->where('trx_registration.status_reg', 0)
			->order_by('trx_registration.create_date desc')
			->get();
	}
}
