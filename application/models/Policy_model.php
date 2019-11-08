<?php 

class Policy_model extends CI_Model {

        // public $title;
        // public $content;
        // public $date;

        public function policy($keyword)
        {
                $query = $this->db->query("SELECT a.entity_id as 'NID', 
case 
when taxonomy_vocabulary_3_tid = 31036 then 'apartment hotel' 
when taxonomy_vocabulary_3_tid = 10499 then 'apts' 
when taxonomy_vocabulary_3_tid = 31069 then 'Bed and Breakfast' 
when taxonomy_vocabulary_3_tid = 10521 then 'bungalow' 
when taxonomy_vocabulary_3_tid = 13 then 'cabin' 
when taxonomy_vocabulary_3_tid = 10518 then 'chalet' 
when taxonomy_vocabulary_3_tid = 14 then 'condo' 
when taxonomy_vocabulary_3_tid = 103 then 'cottage' 
when taxonomy_vocabulary_3_tid = 10502 then 'divers' 
when taxonomy_vocabulary_3_tid = 30682 then 'Duplex' 
when taxonomy_vocabulary_3_tid = 105 then 'estate' 
when taxonomy_vocabulary_3_tid = 10520 then 'farmhouse' 
when taxonomy_vocabulary_3_tid = 10519 then 'holiday village' 
when taxonomy_vocabulary_3_tid = 15 then 'home' 
when taxonomy_vocabulary_3_tid = 30683 then 'Hotel Room' 
when taxonomy_vocabulary_3_tid = 10522 then 'residence' 
when taxonomy_vocabulary_3_tid = 104 then 'retreat' 
when taxonomy_vocabulary_3_tid = 102 then 'townhouse' 
when taxonomy_vocabulary_3_tid = 16 then 'villa' 
when taxonomy_vocabulary_3_tid = 31032 then 'yurt' 
end as 'Type', c.field_pets_ok_value 'Pet Allowed(ACCOMODATIONS)', 
e.city 'city', b.field_amenities_value 'Internet', i.field_amenities_value 'WIFI', h.field_amenities_value 'Pet', 
f.field_amenities_value 'Parking',g.field_amenities_value 'Linen' 
FROM radb.field_data_taxonomy_vocabulary_3 a 
left join 
(select entity_id, field_amenities_value from field_data_field_amenities 
where field_amenities_value in ('Internet') 
) b 
on a.entity_id = b.entity_id 

left join 
(select entity_id, field_amenities_value from field_data_field_amenities 
where field_amenities_value in ('Internet -- Wireless') 
) i 
on a.entity_id = i.entity_id

left join 
(select entity_id, field_amenities_value from field_data_field_amenities 
where field_amenities_value in ('Pets OK') 
) h 
on a.entity_id = h.entity_id 

left join 
(select entity_id, field_amenities_value from field_data_field_amenities 
where field_amenities_value in ('Parking','Parking -- Covered','Parking -- Free', 
'Parking -- Off Street','Parking -- RV') 
) f 
on a.entity_id = f.entity_id 

left join 
(select entity_id, field_amenities_value from field_data_field_amenities 
where field_amenities_value in ('Linens Provided') 
) g 
on a.entity_id = g.entity_id 

left join field_data_field_pets_ok c on a.entity_id = c.entity_id 
left join field_data_field_geolocation d on a.entity_id=d.entity_id 
left join location e on e.lid = d.field_geolocation_lid 

where a.entity_id in ($keyword) 
group by a.entity_id;");
                return $query->result_array();
        }
}