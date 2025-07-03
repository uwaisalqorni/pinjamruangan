<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjamruangan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!in_array($this->session->tipe, ['admin', 'user'])) {
			redirect('/home/login', 'refresh');
		}
		
	}

	public function index()
	{
		$this->datalist();
	}

	protected function __sanitizeString($str)
	{
		return html_purify($str);
	}

	protected function src()
	{
		$katakunci = $this->__sanitizeString($this->input->get('katakunci'));
		$where = [];

		if ($katakunci) {
			$where[] = "nama LIKE '%$katakunci%'";
			$where[] = "nik LIKE '%$katakunci%'";
			$where[] = "unit LIKE '%$katakunci%'";
			$where[] = "tempat LIKE '%$katakunci%'";
			$where[] = "keterangan LIKE '%$katakunci%'";
		}

		$whereClause = !empty($where) ? 'WHERE ' . implode(' OR ', $where) : '';

		$sql = "SELECT * FROM pinjamruangan $whereClause ORDER BY id DESC";
		$sql_row = "SELECT COUNT(*) AS total FROM pinjamruangan $whereClause";

		return [$sql, $sql_row];
	}

	public function datalist($offset = 0)
	{
		$qs = $this->src();
		$sql = $qs[0];
		$sql2 = $qs[1];

		$sql .= " LIMIT 20";
		if ($offset > 0) $sql .= " OFFSET $offset";

		$data['data'] = $this->db->query($sql)->result_array();
		$data['jml'] = $this->db->query($sql2)->row()->total;

		$this->load->library('pagination');
		$config['base_url'] = site_url('/pinjamruangan');
		$config['reuse_query_string'] = true;
		$config['total_rows'] = $data['jml'];
		$config['per_page'] = 20;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		$data['pages'] = $this->pagination->create_links();

		$this->__output('pinjamruangan/main', $data);
	}

	private function __output($view, $data = null)
	{
		if ($this->session->tipe == 'admin') {
			$data['admin'] = true;
		}
		$this->load->view('header', $data);
		$this->load->view($view, $data);
		$this->load->view('footer');
	}

	public function entr()
	{
		$data['title'] = "Tambah Peminjaman Ruangan";
		$data['now'] = date('Y-m-d H:i');
		$this->__output('pinjamruangan/entri', $data);
	}


	public function gentr()
	{
		$nama = $this->__sanitizeString($this->input->post('nama'));
		$nik = $this->__sanitizeString($this->input->post('nik'));
		$unit = $this->__sanitizeString($this->input->post('unit'));

		// 🔥 Konversi datetime ke format 24 jam database
		$datetime_input = $this->__sanitizeString($this->input->post('datetime'));
		$datetime = date('Y-m-d H:i:s', strtotime($datetime_input));

		$tempat = $this->__sanitizeString($this->input->post('tempat'));
		$jumlah = (int)$this->input->post('jumlah');
		$keterangan = $this->__sanitizeString($this->input->post('keterangan'));

		$sql = "INSERT INTO pinjamruangan (nama, nik, unit, datetime, tempat, jumlah, keterangan)
				VALUES (?, ?, ?, ?, ?, ?, ?)";
		$this->db->query($sql, [$nama, $nik, $unit, $datetime, $tempat, $jumlah, $keterangan]);

		redirect('/pinjamruangan', 'refresh');
	}


	public function del()
	{
		$id = (int) $this->input->post('id');
		$this->db->delete('pinjamruangan', ['id' => $id]);
	}

	public function setuju()
	{
		$id = (int) $this->input->post('id');
		$this->db->where('id', $id)->update('pinjamruangan', ['status' => 'disetujui']);
		redirect('/pinjamruangan');
	}

	public function tolak()
	{
		$id = (int) $this->input->post('id');
		$this->db->where('id', $id)->update('pinjamruangan', ['status' => 'ditolak']);
		redirect('/pinjamruangan');
	}


	public function vedit($id)
	{
		// 🔥 Allow admin dan user
		if (!in_array($this->session->tipe, ['admin', 'user'])) {
			show_error('Anda tidak memiliki akses ke halaman ini.', 403);
			return;
		}

		if ($id) {
			$row = $this->db->get_where('pinjamruangan', ['id' => $id])->row_array();

			if ($row) {
				$data = [
					'id'         => $row['id'],
					'nama'       => $row['nama'],
					'nik'        => $row['nik'],
					'unit'       => $row['unit'],
					'datetime'   => $row['datetime'],
					'tempat'     => $row['tempat'],
					'jumlah'     => $row['jumlah'],
					'keterangan' => $row['keterangan'],
					'status'     => $row['status'], // ✅ Status
					'title'      => "Edit Peminjaman Ruangan"
				];

				$this->__output('pinjamruangan/edit', $data);
			} else {
				$this->session->set_flashdata('error', 'Data tidak ditemukan.');
				redirect('/pinjamruangan');
			}
		} else {
			$this->session->set_flashdata('error', 'ID tidak valid.');
			redirect('/pinjamruangan');
		}
	}



	public function update()
	{
		if (!in_array($this->session->tipe, ['admin', 'user'])) {
			show_error('Anda tidak memiliki akses untuk update data.', 403);
			return;
		}

		$id = (int)$this->input->post('id');

		// 🔥 Konversi datetime ke format 24 jam database
		$datetime_input = $this->__sanitizeString($this->input->post('datetime'));
		$datetime = date('Y-m-d H:i:s', strtotime($datetime_input));

		$data = [
			'nama'       => $this->__sanitizeString($this->input->post('nama')),
			'nik'        => $this->__sanitizeString($this->input->post('nik')),
			'unit'       => $this->__sanitizeString($this->input->post('unit')),
			'datetime'   => $datetime,
			'tempat'     => $this->__sanitizeString($this->input->post('tempat')),
			'jumlah'     => (int)$this->input->post('jumlah'),
			'keterangan' => $this->__sanitizeString($this->input->post('keterangan'))
		];

		$this->db->where('id', $id)->update('pinjamruangan', $data);

		$this->session->set_flashdata('success', 'Data berhasil diupdate.');
		redirect('/pinjamruangan/vedit/'.$id);
	}



	public function resetstatus($id)
	{
		if ($this->session->tipe != 'admin') {
			show_error('Anda tidak memiliki akses untuk reset status', 403);
			return;
		}

		$this->db->where('id', (int)$id)->update('pinjamruangan', ['status' => 'menunggu']);
		$this->session->set_flashdata('success', 'Status berhasil direset.');
		redirect('/pinjamruangan/vedit/'.$id);
	}

	public function view($id)
		{
			if (!in_array($this->session->tipe, ['admin', 'user'])) {
				show_error('Anda tidak memiliki akses untuk melihat data.', 403);
				return;
			}

			if ($id) {
				$row = $this->db->get_where('pinjamruangan', ['id' => $id])->row_array();

				if ($row) {
					$data = [
						'id'         => $row['id'],
						'nama'       => $row['nama'],
						'nik'        => $row['nik'],
						'unit'       => $row['unit'],
						'datetime'   => $row['datetime'],
						'tempat'     => $row['tempat'],
						'jumlah'     => $row['jumlah'],
						'keterangan' => $row['keterangan'],
						'status'     => $row['status'],
						'title'      => "Detail Peminjaman Ruangan"
					];

					$this->__output('pinjamruangan/view', $data);
				} else {
					$this->session->set_flashdata('error', 'Data tidak ditemukan.');
					redirect('/pinjamruangan');
				}
			} else {
				$this->session->set_flashdata('error', 'ID tidak valid.');
				redirect('/pinjamruangan');
			}
		}
	
		public function report($id)
		{
			if (!in_array($this->session->tipe, ['admin', 'user'])) {
				show_error('Anda tidak memiliki akses untuk melihat report.', 403);
				return;
			}

			$row = $this->db->get_where('pinjamruangan', ['id' => $id])->row_array();

			if ($row) {
				$data = [
					'id'         => $row['id'],
					'nama'       => $row['nama'],
					'nik'        => $row['nik'],
					'unit'       => $row['unit'],
					'datetime'   => $row['datetime'],
					'tempat'     => $row['tempat'],
					'jumlah'     => $row['jumlah'],
					'keterangan' => $row['keterangan'],
					'status'     => $row['status'],
					'title'      => "Lihat Report"
				];

				$this->__output('pinjamruangan/report', $data);
			} else {
				$this->session->set_flashdata('error', 'Data tidak ditemukan.');
				redirect('/pinjamruangan');
			}
		}
	
		public function report_pdf($id)
		{
			if (!in_array($this->session->tipe, ['admin', 'user'])) {
				show_error('Anda tidak memiliki akses untuk mencetak PDF.', 403);
				return;
			}
		
			$row = $this->db->get_where('pinjamruangan', ['id' => $id])->row_array();
		
			if ($row) {
				$data = [
					'id'         => $row['id'],
					'nama'       => $row['nama'],
					'nik'        => $row['nik'],
					'unit'       => $row['unit'],
					'datetime'   => $row['datetime'],
					'tempat'     => $row['tempat'],
					'jumlah'     => $row['jumlah'],
					'keterangan' => $row['keterangan'],
					'status'     => $row['status'],
					'title'      => "Laporan Peminjaman Ruangan"
				];
		
				// Render view HTML
				$html = $this->load->view('pinjamruangan/report_pdf', $data, true);
		
				// Load Dompdf
				$this->load->library('pdf');
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'portrait');
				$this->pdf->render();
		
				// Output PDF ke browser
				$this->pdf->stream("Peminjaman_Ruangan_".$row['nama'].".pdf", array("Attachment" => false));
			} else {
				$this->session->set_flashdata('error', 'Data tidak ditemukan.');
				redirect('/pinjamruangan');
			}
		}		


}
