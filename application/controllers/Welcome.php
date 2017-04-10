<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	

	 public function __construct() {
        parent::__construct();
        $this->load->model('Mymodel'); //load model model_upldgbr yang berada di folder model
        $this->load->helper(array('url')); //load helper url 

    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function hellow()
	{
		$data = array(
			'nama'=>'rojib',
			'kelas'=>'13-SI-02'
			);
		// echo "hellow world";

		$this->load->view('hello',$data);
	}

	public function mahasiswa()
	{
		$data = $this->db->query("select * from mahasiswa");
		foreach($data->result_array() as $mahasiswa){
			echo 'Nama : '.$mahasiswa['nama'].'<br/>';
			echo 'Kelas : '.$mahasiswa['kelas'].'<hr/>';
		}
	}

	public function mhs()
	{
		$this->load->model('Mymodel');

		$data = $this->Mymodel->GetMahasiswa();
		foreach($data as $mahasiswa){
			echo 'Nama : '.$mahasiswa['nama'].'<br/>';
			echo 'Kelas : '.$mahasiswa['kelas'].'<hr/>';
		}
	}

	public function data()
	{
		$this->load->model('Mymodel');

		$data = $this->Mymodel->GetMahasiswa('mahasiswa');
		$data = array('data'=>$data);

		$this->load->view('mahasiswa',$data);
	}

	public function tambah_data()
	{
		$this->load->view('tambah_mahasiswa');
	}

	public function insert()
	{
        $this->load->library('upload');

		$this->load->model('Mymodel');

		 $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = 'gambar/mahasiswa/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        
        // if($_FILES['filefoto']['name'])
        // {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
                  // 'namafile' =>$gbr['file_name'],
                  // 'type' =>$gbr['file_type'],
                  // 'keterangan' =>$this->input->post('textket')
                  'nim' => $this->input->post('nim'),
					'nama' => $this->input->post('nama'),
					'kelas' => $this->input->post('kelas'),
					'alamat' => $this->input->post('alamat'),
					'foto' => $gbr['file_name']
                  
                );
                // print_r($data);
                // die();

                $this->Mymodel->insert('mahasiswa',$data); //akses model untuk menyimpan ke database

                // $config2['image_library'] = 'gd2'; 
                // $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                // $config2['new_image'] = './assets/hasil_resize/'; // folder tempat menyimpan hasil resize
                // $config2['maintain_ratio'] = TRUE;
                // $config2['width'] = 100; //lebar setelah resize menjadi 100 px
                // $config2['height'] = 100; //lebar setelah resize menjadi 100 px
                // $this->load->library('image_lib',$config2); 

                //pesan yang muncul jika resize error dimasukkan pada session flashdata
              //   if ( !$this->image_lib->resize()){
              //   $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
              // }
                //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
		redirect(base_url()."index.php/welcome/data",'refresh');
                // redirect('upload'); //jika berhasil maka akan ditampilkan view upload
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                // redirect('upload/add'); //jika gagal maka akan ditampilkan form upload
		// redirect(base_url()."index.php/welcome/tambah_data",'refresh');
            	echo $this->upload->display_errors();
            	
            }
        // }

		// $this->load->library('upload',$config);
		// if(!$this->upload->do_upload('foto')){
		// 	$error = array('error'=>$this->upload->display_errors());
		// 	$this->load->view('tambah_mahasiswa',$error);
		// }else{
		// 	$gambar = $this->upload->data();
		// 	$data = array(
		// 	'NIM' => $this->input->post('nim'),
		// 	'nama' => $this->input->post('nama'),
		// 	'kelas' => $this->input->post('kelas'),
		// 	'alamat' => $this->input->post('alamat'),
		// 	'foto' => $gambar['file_name']
		// 	);
		// 	$data = $this->Mymodel->insert('mahasiswa',$data);
		// redirect(base_url()."index.php/welcome/data",'refresh');

		// 	// $this->load->view('mahasiswa';
		// }

		// $data = array(
		// 	'NIM' => $this->input->post('nim'),
		// 	'nama' => $this->input->post('nama'),
		// 	'kelas' => $this->input->post('kelas'),
		// 	'alamat' => $this->input->post('alamat')
		// 	);

		// $data = $this->Mymodel->insert('mahasiswa',$data);

		// redirect(base_url()."index.php/welcome/data",'refresh');
	}

	public function hapus_data($nim)
	{
		$this->load->model('Mymodel');

		$path = 'gambar/mahasiswa/';
		$nim = array('nim'=>$nim);
		$row = $this->Mymodel->GetWhere('mahasiswa',$nim);
		// print_r($row[0]['foto']);
		// die();
		@unlink($path.$row[0]['foto']);

		$this->Mymodel->delete('mahasiswa',$nim);
		$this->session->set_flashdata('pesan','Data berhasil dihapus');
		redirect(base_url()."index.php/welcome/data",'refresh');
	}

	public function edit_data($nim)
	{
		$this->load->model('Mymodel');

		$mhs = $this->Mymodel->GetWhere('mahasiswa',array('nim'=>$nim));
		$data = array(
			'nim'=>$mhs[0]['nim'],
			'nama'=>$mhs[0]['nama'],
			'kelas'=>$mhs[0]['kelas'],
			'alamat'=>$mhs[0]['alamat'],
			'foto'=>$mhs[0]['foto']);

		$this->load->view('edit_mahasiswa',$data);
	}

	public function update()
	{
		$this->load->model('Mymodel');
		$this->load->library('upload');
		$nmfile = "file_".time(); //nama file diikuti fungsi waktu
		$path   = "gambar/mahasiswa/";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['max_size'] = '2048';
		$config['max_width'] = '2048';
		$config['max_height'] = '2048';
		$config['file_name'] = $nmfile; //nama file yg terupload nantinya

		$this->upload->initialize($config);

		$id = $this->input->post('nim');
		$fileLama = $this->input->post('foto');

		if($_FILES['filefoto']['name'])
		{
			if($this->upload->do_upload('filefoto'))
			{
				$gbr = $this->upload->data();
				$data = array(
                 
                  'nim' => $this->input->post('nim'),
					'nama' => $this->input->post('nama'),
					'kelas' => $this->input->post('kelas'),
					'alamat' => $this->input->post('alamat'),
					'foto' => $gbr['file_name']
                  
                );

                @unlink($path.$fileLama); //menghapus gambar lama

                $where = array('nim'=>$id);
                $this->Mymodel->update('mahasiswa',$data,$where);

                $this->session->set_flashdata('pesan','Edit dan upload data berhasil');
				redirect(base_url()."index.php/welcome/data",'refresh');
				die();
			}else{ //jika upload gagal
				echo $this->upload->display_errors();
				$this->session->set_flashdata('pesan',$this->upload->display_errors());
				redirect(base_url()."index.php/welcome/edit_data/".$id,'refresh');

			}
		}else{ //jika tidak ada foto yg di upload
			$data = array(
				'nim' => $this->input->post('nim'),
				'nama' => $this->input->post('nama'),
				'kelas' => $this->input->post('kelas'),
				'alamat' => $this->input->post('alamat')
				// 'foto' => $gbr['file_name']
                );

			$where = array('nim'=>$id);
                $this->Mymodel->update('mahasiswa',$data,$where);
             $this->session->set_flashdata('pesan','Edit berhasil dan tidak ada foto yg di upload');
				die();
				
				redirect(base_url()."index.php/welcome/data",'refresh');   
		}
		// $nim = $_POST['nim'];
		// $nama = $_POST['nama'];
		// $kelas = $_POST['kelas'];
		// $alamat = $_POST['alamat'];

		// $data = array(
			
		// 	'nama'=>$nama,
		// 	'kelas'=>$kelas,
		// 	'alamat'=>$alamat);

		// $where = array('nim'=>$nim);

		// $response = $this->Mymodel->update('mahasiswa',$data,$where);
		// if($response>0){	
		// 	redirect(base_url()."index.php/welcome/data",'refresh');
		// }
			
	}
}
