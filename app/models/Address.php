<?php

class Address extends Eloquent {

    public function getAddressAttribute(){
        $ret = $this->house_no.' ถนน'.$this->road;
        if(!empty($this->village_no)){
            $ret .= ' หมู่ '.$this->village_no;
        }
        if(!empty($this->village)){
            $ret .= ' หมู่บ้าน'.$this->village_no;
        }
        if(!empty($this->sub_district)){
            if($this->province->id == 1){
                $ret .= ' แขวง'.$this->sub_district->name;
            }else {
                $ret .= ' ตำบล' . $this->sub_district->name;
            }
        }
        if(!empty($this->district)){
            if($this->province->id == 1){
                $ret .= ' เขต'.$this->sub_district->name;
            }else {
                $ret .= ' อำเภอ' . $this->sub_district->name;
            }
        }
        $ret .= ' จังหวัด'.$this->province->name.' '.$this->postcode;
        return $ret;
    }

    public function user() {
        return $this->belongsTo('User');
    }
    
    public function province(){
        return $this->belongsTo('Province');
    }

    public function district(){
        return $this->belongsTo('District');
    }
    
    public function subDistrict(){
        return $this->belongsTo('SubDistrict');
    }
}
