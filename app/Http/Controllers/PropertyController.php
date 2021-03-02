<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyImage;
use App\PropertyAddress;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use MongoDB\Driver\Exception\Exception;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::with('images')->with('address')->where('available',true)->get();
        return response($properties->jsonSerialize(), 200);
    }

    public function get_all(){
        $properties = Property::with('images')->with('address')->get();
        return response($properties->jsonSerialize(), 200);
    }

    /**
     * Função que calcula a distância entre dois pontos, utilizando a formula de Harversine
     * @param $id
     */

    public function get_recommendations(Request $request, $id){
        $reference = Property::find($id);
        $latitude = $reference->address->lat;
        $longitude = $reference->address->long;
        $radius = 50;

        $indications = \DB::table('properties')
            ->join('property_addresses as addresses','addresses.property_id','=','properties.id')
            ->join('property_images as images','images.property_id','=','properties.id')
            ->select(
                \DB::raw("properties.id as property_id, properties.*,  addresses.*, images.*, (
            6371 * 2 * asin(
                sqrt(
                    power(sin(radians(? - addresses.lat)/2),2) +
                    cos(radians(addresses.lat))*
                    cos(radians(?)) *
                    power(sin(radians(? - addresses.long)/2),2)
                )
            )
       ) AS distance")
            )
            ->having("properties.id",'!=','?')
            ->having('distance','<','?')
            ->orderBy("distance")
            ->take(4)
            ->setBindings([floatval($latitude), floatval($latitude), floatval($longitude),$id,$radius])
            ->get();

        $recommendations = array();
        foreach(json_decode($indications,true) as $indication){
            array_push($recommendations,$indication['property_id']);
        }
        $recommendations = array_unique($recommendations);
        return response((Property::whereIn('id',$recommendations)->with('images')->with("address")->get())->jsonSerialize(),200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'title'=>'required',
            'description'=> 'required',
            'rent_price'=> 'required',
            'city'=> 'required',
            'state'=>'required',
            'country'=>'required',
            'street' =>'required',
            'neighborhood'=>'required',
            'number'=> 'required'
        ]);
        if($validator->fails()){
            return response(['Um erro aconteceu ao criar novo anuncio'], 400);
        }
        try{
            $property = new Property();
            $property->title = json_decode($request->title);
            $property->description = json_decode($request->description);
            $property->rent_price = json_decode($request->rent_price);
            $property->available = json_decode($request->available);
            $property->save();
            foreach($request->allFiles() as $image){
                $property_image = new PropertyImage();
                $path = $image->store('images','public');
                $property_image->url = '/storage/'.$path;
                $property_image->property_id = $property->id;
                $property_image->save();
            }
            $address = new PropertyAddress();
            $address->city = json_decode($request->city);
            $address->state = json_decode($request->state);
            $address->country = json_decode($request->country);
            $address->street = json_decode($request->street);
            $address->neighborhood = json_decode($request->neighborhood);
            $address->number = json_decode($request->number);
            $address->complement = json_decode($request->complement);
            $latLong = \GoogleMaps::load('geocoding')
                ->setParam(['address' =>$address->street." ".$address->complement." ".$address->number." ".$address->neighborhood." ".$address->city." ".$address->state." ".$address->country])->get('results.geometry');
            $address->lat = $latLong['results'][0]['geometry']['location']['lat'];
            $address->long = $latLong['results'][0]['geometry']['location']['lng'];
            $address->property_id = $property->id;
            $address->save();
            return response($property->jsonSerialize(), 201);
        }catch (\Exception $e){
            echo $e;
            return response(['Um erro aconteceu ao criar novo anuncio'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $property = Property::where("id",'=',$id)->with('images')->with('address')->first();
            return response($property->jsonSerialize(), 200);
        }catch(\Exception $e){
            return response(['Propriedade não encontrada'],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            return response(Property::find($id)->jsonSerialize(), 200);
        }catch(\Exception $e){
            return response(['Propriedade não encontrada'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description'=> 'required',
            'rent_price'=> 'required',
            'city'=> 'required',
            'state'=>'required',
            'country'=>'required',
            'street' =>'required',
            'neighborhood'=>'required',
            'number'=> 'required'
        ]);
        if($validator->fails()){
            return response(['Um erro aconteceu ao editar novo anuncio'], 400);
        }
        try{
            $property = Property::find($id);
            $property->title = json_decode($request->title);
            $property->description = json_decode($request->description);
            $property->rent_price = json_decode($request->rent_price);
            $property->available = json_decode($request->available);
            $property->save();

            $images_to_delete = array_values(json_decode($request->newImages));

            if(! ($property->images->count() == sizeof($images_to_delete) )){
                foreach($images_to_delete as $img){
                    $image = PropertyImage::find($img);
                    $image->delete();
                }
            }

            foreach($request->allFiles() as $image){
                $property_image = new PropertyImage();
                $path = $image->store('images','public');
                $property_image->url = '/storage/'.$path;
                $property_image->property_id = $property->id;
                $property_image->save();
            }
            $address = $property->address;
            $address->city = json_decode($request->city);
            $address->state = json_decode($request->state);
            $address->country = json_decode($request->country);
            $address->street = json_decode($request->street);
            $address->neighborhood = json_decode($request->neighborhood);
            $address->number = json_decode($request->number);
            $address->complement = json_decode($request->complement);
            $latLong = \GoogleMaps::load('geocoding')
                ->setParam(['address' =>$address->street." ".$address->complement." ".$address->number." ".$address->neighborhood." ".$address->city." ".$address->state." ".$address->country])->get('results.geometry');
            $address->lat = $latLong['results'][0]['geometry']['location']['lat'];
            $address->long = $latLong['results'][0]['geometry']['location']['lng'];
            $address->save();
            return response($property->jsonSerialize(), 200);
        }catch (\Exception $e){
            return response($e->getMessage(), 400);
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $property = Property::find($id);
            $property->delete();
            return response(['Propriedade apagada com sucesso!'], 204);
        }catch(Exception $e){
            return response(['Ocorreu um erro ao apagar propriedade'], 500);
        }

    }
}
