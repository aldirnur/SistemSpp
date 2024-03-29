<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Transaksi";
        $transaksi = Transaksi::whereNull('token')->orderBy('created_at', 'desc')->get();
        $menu = 'Pembayaran';

        return view('data_keuangan.transaksi',compact(
            'title','transaksi','menu'
        ));
    }



    public function create(){
        $title= "Add Transaksi";
        $siswa = Siswa::get();
        $menu = 'Pembayaran';
        return view('data_keuangan.tambah_transaksi',compact(
            'title','siswa','menu'
        ));
    }


    /**
     * Display a listing of expired resources.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of out of stock resources.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'keterangan'=>'required',
            'date' => 'required|date_format:Y-m-d',
            'nominal'=>'required',
        ];

        $customMessages = [
            'keterangan.required' => 'Keterangan Harus Diisi',
            'date.required' => 'Tanggal Harus Diisi',
            'nominal.required' => 'Nominal Harus Diisi'
        ];

        $this->validate($request, $rules, $customMessages);
        $random = '';
        $limit = 4;
        for($i = 0; $i < $limit; $i++) {
            $random .= mt_rand(0, 9);
        }
        $code = date("ymd") . $random;
        // $image = $request->file('file');
        // $path = public_path('/img/payment/');
        // $imageName = $image->getClientOriginalName();
        // $imageLinkTree = $image->getClientOriginalExtension();
        // // $imageName = $this->newName($imageName, 'bukti_tf_');
        // $image->move(($path), $imageName);
        $type = $request->type;


        $cek_tagihan = Tagihan::where('id_siswa',  $request->siswa)->first();
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
            // $transaksi->token = $otp;
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


        $notification=array(
            'message'=>"transaksi Berhasil Ditambahkan has been added",
            'alert-type'=>'success',
        );
        return redirect()->route('transaksi')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $title = "Edit Transaksi";
        $status = [1 => "Diterima" , 2 => 'Verifikasi', 3 => "Ditolak"];
        $transaksi = Transaksi::find($id);
        $menu = 'Pembayaran';
        return view('data_keuangan.edit_transaksi',compact(
            'title','transaksi','status', 'menu'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $rules = [
            'keterangan'=>'required',
            'date' => 'required|date_format:Y-m-d',
            'nominal'=>'required',
        ];

        $customMessages = [
            'keterangan.required' => 'Keterangan Harus Diisi',
            'date.required' => 'Tanggal Harus Diisi',
            'nominal.required' => 'Nominal Harus Diisi'
        ];
        $this->validate($request, $rules, $customMessages);
        $transaksi = Transaksi::find($id);
        if ($transaksi) {
            $transaksi->status_transaksi = $request->status;
            $transaksi->tgl = $request->date;
            $transaksi->nominal_transaksi = $request->nominal;
            $transaksi->keterangan = $request->keterangan;
            $transaksi->save();

            if ($transaksi->status == 3) {
                if ($request->user_note) {
                    $transaksi->user_note = $request->user_note;
                    $transaksi->save();
                    if($transaksi->id_tagihan != null) {
                        // try {

                        //     $basic  = new \Vonage\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
                        //     $client = new \Vonage\Client($basic);

                        //     $response = $client->sms()->send(
                        //         new \Vonage\SMS\Message\SMS($transaksi->tagihan->siswa->no_tlp, 'Keuangan BKM', 'Yth. ' . $transaksi->tagihan->siswa->nama . ' Kelas ' . $transaksi->tagihan->siswa->kelas . ' Pembayaran Ditolak !. Karena ' . $request->user_note)
                        //     );

                        //     $message = $response->current();

                        // } catch (Exception $e) {
                        //     $notification=array(
                        //         'message'=>"Maaf, Mengirim SMS Gagal",
                        //         'alert-type'=>'danger',
                        //     );
                        //     return back()->with($notification);
                        // }

                    }
                } else {
                    $notification=array(
                        'message'=>"Maaf, Keterangan Ditolak Harus Diisi",
                        'alert-type'=>'danger',
                    );
                    return back()->with($notification);
                }

            }
            if ($transaksi->status_transaksi == 1) {
                // $keuangan = New Keuangan();
                // $keuangan->tgl = date('Y-m-d');
                // // $keuangan->id_kategori = $transaksi->id_kategori;

                // // if ($transaksi->kategori->type == 1) {
                // $keuangan->nominal_kas = $transaksi->nominal_transaksi;
                // $keuangan->notes = $transaksi->keterangan;
                // $keuangan->trans_id = $transaksi->trans_id;
                // $keuangan->save();
                // dd($keuangan);

                if($transaksi->tag_id != null) {
                    $tagihan = Tagihan::find($transaksi->tag_id);
                    $nominal_tagihan = (isset($tagihan->spp->nominal_spp) ? $tagihan->spp->nominal_spp : 0) * $tagihan->jumlah;
                    $sisa_tagihan = ($nominal_tagihan - $transaksi->nominal_transaksi ) / $tagihan->spp->nominal_spp;
                    $tagihan->jumlah = $sisa_tagihan;;
                    $tagihan->save();

                    if ($tagihan->jumlah == 0) {
                        $tagihan->status = 1;
                        $tagihan->save();
                    }
                }
            }
        }

        $notification=array(
            'message'=>"Transaksi has been updated",
            'alert-type'=>'success',
        );
        return redirect()->route('transaksi')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    }


}
