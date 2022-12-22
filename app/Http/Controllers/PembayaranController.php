<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Transaksi;
use Exception;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $title = "pembayaran";
        $siswa = Siswa::where('nisn', $request->nisn)->where('pin', $request->pin)->first();
        $tagihan = 0;
        $transaksi = [];
        if ($siswa) {
            $tagihan = Tagihan::where('id_siswa', $siswa->id_siswa)->first();
            if ($tagihan) {
                $transaksi = Transaksi::where('tag_id', $tagihan->tag_id)->whereNull('token')->get();
            }
            // if (!$tagihan) {
            //     return back()->with('error_kode',"Anda Belum Memiliki Tagihan , Silahkan Hubungi Admin!!");
            // }
        } else {
            return back()->with('error_kode',"Kode Yang Anda Masukan Tidak Terdaftar!!");
        }
        // dd($siswa);
        return view('halaman_siswa.pembayaran',compact(
            'title','siswa'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_siswa)
    {
        // dd($request->all());
        $rules = [
            'file'=>'required',
        ];

        $customMessages = [
            'file.required' => 'File Harus Diisi',
        ];

        $this->validate($request, $rules, $customMessages);

        $random = '';
        $limit = 6;
        for($i = 0; $i < $limit; $i++) {
            $random .= mt_rand(0, 9);
        }

        $otp = '';
        $limit = 6;
        for($i = 0; $i < $limit; $i++) {
            $otp .= mt_rand(0, 9);
        }
        $cek_tagihan = Tagihan::where('id_siswa',  $id_siswa)->first();
        if ($cek_tagihan) {
            $image = $request->file('file');
            $path = public_path('/img/payment/');
            $imageName = $image->getClientOriginalName();
            $extensi = $image->getClientOriginalExtension();
            $image->move(($path), $imageName);
            if (!in_array($extensi, ['jpg', 'jpeg', 'png'])) {
                $notification=array(
                    'message'=>"Maaf, Format File Harus JPG,JPEG atau PNG",
                    'alert-type'=>'danger',
                );
                return back()->with($notification);
            }

            $code = date("d") . $random;
            $transaksi = New Transaksi();
            $transaksi->no_transaksi = $code;
            $transaksi->status_transaksi = 2;
            $transaksi->tgl = date('Y-m-d');
            $transaksi->nominal_transaksi = $request->nominal;
            $transaksi->keterangan = $request->keterangan ? : 'Pembayaran Spp';
            $transaksi->bukti_transaksi = $imageName;
            $transaksi->tag_id = $cek_tagihan->tag_id;
            $transaksi->token = $otp;
            $transaksi->save();

            // dd($transaksi->tagihan->siswa->no_tlp);

            // if ($transaksi->token != null) {
            //     try {
            //         $basic  = new \Vonage\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
            //         $client = new \Vonage\Client($basic);

            //         $response = $client->sms()->send(
            //             new \Vonage\SMS\Message\SMS($transaksi->tagihan->siswa->no_tlp, 'Verif', 'Kode Token Anda Adalah '. $transaksi->token. ' ' )
            //         );

            //         $message = $response->current();

            //     } catch (Exception $e) {
            //         $notification=array(
            //             'message'=>$e->getMessage(),
            //             'alert-type'=>'danger',
            //         );
            //         return back()->with($notification);
            //     }

            // }

            $notification=array(
                'message'=>"Maaf, Tagihan Anda Belum Terdaftar. Silahkan Hubungi Petugas",
                'alert-type'=>'popup',
            );
            // $notification=array(
            //     'message'=>"Pembayaran Berhasil",
            //     'alert-type'=>'success',
            // );
        } else {
            $notification=array(
                'message'=>"Maaf, Tagihan Anda Belum Terdaftar. Silahkan Hubungi Petugas",
                'alert-type'=>'danger',
            );
        }



        return back()->with($notification);
    }

    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    }

    public function getTagihan(Request $request)
    {
        $id = $request->id;
        $jumlah = $request->jumlah;
        $tagihan = Tagihan::where('id_siswa', $id)->first();
        $nominal_tagihan = 0;
        if ($tagihan) {
            $nominal_tagihan = (isset($tagihan->spp->nominal_spp) ? $tagihan->spp->nominal_spp : 0) * $jumlah  ;
            if ($tagihan->jumlah == 0) {
                return response()->json(['status' => 'failed', 'nom' => $tagihan->jumlah, 'message' => 'Maaf, Anda Sudah Tidak Memiliki Tagihan']);
            }
            if ($jumlah > $tagihan->jumlah ) {
                return response()->json(['status' => 'failed', 'nom' => $tagihan->jumlah, 'message' => 'Maaf, Jumlah Bulan Yang Anda Masukan Lebih,  Sisa Tagihan Anda Sebanyak ' . $tagihan->jumlah . ' Bulan']);
            }
        } else {
            return response()->json(['status' => 'failed', 'nom' => '0', 'message' => 'Maaf, Anda Tidak Memiliki Tagihan. SIlahkan Hubungi Petugas!']);
        }
        return response()->json(['status' => 'success', 'nom' => $nominal_tagihan]);
    }

    public function cekToken(Request $request)
    {
        $rules = [
            'token'=>'required',
        ];

        $customMessages = [
            'token.required' => 'Silahkan Masukan Token',
        ];

        $this->validate($request, $rules, $customMessages);
        $cek_transaksi = Transaksi::where('token',  $request->token)->first();
        if ($cek_transaksi) {
            // $notification=array(
            //     'message'=>"Maaf, Tagihan Anda Belum Terdaftar. Silahkan Hubungi Petugas",
            //     'alert-type'=>'popup',
            // );
            $cek_transaksi->token = null;
            $cek_transaksi->save();
            $notification=array(
                'message'=>"Pembayaran Berhasil, Hubungi Petugas Untuk Melakukan Verifikasi",
                'alert-type'=>'success',
            );
        } else {
            $notification=array(
                'message'=>"Maaf,Token Yang Anda Masukan Salah. Silahkan Lakukan Pembayaran Kembali",
                'alert-type'=>'popup',
            );

            // $cek_transaksi->delete();
        }

        return back()->with($notification);
    }

    public function history($id)
    {
        $title = "Transaksi";
        $siswa = Siswa::find($id);
        $tagihan = Tagihan::where('id_siswa', $id)->first();
        $transaksi = [];
        if ($tagihan) {
            $transaksi = Transaksi::whereNull('token')->where('tag_id', $tagihan->tag_id)->orderBy('created_at', 'desc')->get();
        }

        $menu = 'Pembayaran';
        return view('halaman_siswa.history',compact(
            'title','transaksi','menu', 'siswa'
        ));
    }
}
