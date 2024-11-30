<?php
class M_admin extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }
    
    // //=============================== DEIVICE_ID ===============================
    public function dropdown_gh()
    {
        return [
            '-Pilih-' => '-Pilih-',
            1 => 'Greenhouse 1',
            2 => 'Greenhouse 2',
            3 => 'Greenhouse 3',
            4 => 'Greenhouse 4',
            5 => 'Greenhouse 5'
        ];
    }
    public function dropdown_node()
    {
        return [
            '-Pilih-' => '-Pilih-',
            1 => 'Node 1',
            2 => 'Node 2',
            3 => 'Node 3'
        ];
    }

    public function dropdown_device()
    {
        $query = $this->db->get('device_list');
        $result = $query->result();

        $device_id = array('-Pilih-');
        $device_name = array('-Pilih-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($device_id, $result[$i]->device_id);
            array_push($device_name, $result[$i]->device_id);
        }
        return array_combine($device_id, $device_name);
    }    

    public function dt_device($id = FALSE)
    {
        $query = $this->db->get('device_list');
        return $query->result_array();
    }
    public function dt_device_tambah()
    {
        $data = array(
            'device_id' => $this->input->post('device_id'),
            'gh_number' => $this->input->post('gh_number'),
            'node_id' => $this->input->post('node_id')
        );
        return $this->db->insert('device_list', $data);
    }

    public function dt_device_edit($id)
    {
        $data = array(
            'device_id' => $this->input->post('device_id'),
            'gh_number' => $this->input->post('gh_number'),
            'node_id' => $this->input->post('node_id'),
        );
        $this->db->where('device_id', $id);
        return $this->db->update('device_list', $data);
    }

    //=============================== TOPIC ===============================
    public function dropdown_topic()
    {
        $query = $this->db->get('topik');
        $result = $query->result();

        $id_topic = array('-Pilih-');
        $nama_topic = array('-Pilih-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($id_topic, $result[$i]->id);
            array_push($nama_topic, $result[$i]->topic_name);
        }
        return array_combine($id_topic, $nama_topic);
    }

    public function dt_topic($id = FALSE)
    {
        $this->db->select('topic_name, id');
        $this->db->from('topik');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function topik_tambah()
    {
        $data = array(
            'topic_name' => $this->input->post('topic_name'),
        );

        return $this->db->insert('topik', $data);
    }

    public function dt_topik_edit($id)
    {
        $data = array(
            'topic_name' => $this->input->post('topic_name'),
        );
        $this->db->where('id', $id);
        return $this->db->update('topik', $data);
    }
    //=============================== DATA LOGGING SENSOR===============================
    public function dt_sensor_device($id)
    {
        $this->db->select('s.id_santri, s.nama_santri, s.nama_alias, g.nama_guru');
        $this->db->from('santri s');
        $this->db->join('guru g', 's.id_guru = g.id_guru', 'left');
        $this->db->where('s.id_kelas', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function dt_sensor($id)
    {
        // Query untuk mendapatkan gh_number berdasarkan device_id
        $this->db->select('gh_number');
        $this->db->from('device_list');
        $this->db->where('device_id', $id);
        $gh_v_query = $this->db->get();
    
        // Periksa apakah data ditemukan
        if ($gh_v_query->num_rows() > 0) {
            $gh_v = $gh_v_query->row(); // Ambil satu baris data sebagai objek
    
            // Pastikan gh_number valid
            if (isset($gh_v->gh_number) && !empty($gh_v->gh_number)) {
                $tabel = 'greenhouse_' . $gh_v->gh_number; // Nama tabel dinamis
    
                // Ambil data dari tabel dinamis
                $this->db->select('*');
                $this->db->from($tabel);
                $this->db->where('device_id', $id);
                $query = $this->db->get();
                return $query->result_array(); // Kembalikan data dalam bentuk array
            }
        }
    
        // Jika tidak ada data atau gh_number tidak valid, kembalikan array kosong
        return [];
    }

    public function sensor_del($id){
        $this->db->select('gh_number');
        $this->db->from('device_list');
        $this->db->where('device_id', $id);
        $gh_v_query = $this->db->get();
    
        // Periksa apakah data ditemukan
        if ($gh_v_query->num_rows() > 0) {
            $gh_v = $gh_v_query->row(); // Ambil satu baris data sebagai objek
    
            // Pastikan gh_number valid
            if (isset($gh_v->gh_number) && !empty($gh_v->gh_number)) {
                $tabel = 'greenhouse_' . $gh_v->gh_number; // Nama tabel dinamis
    
                // Ambil data dari tabel dinamis
                $this->db->select('*');
                $this->db->from($tabel);
                $this->db->delete($tabel, array('device_id' => $id));
                if (!$this->db->affected_rows())
                    return (FALSE);
                else
                    return (TRUE);
            }
        }

    }

}