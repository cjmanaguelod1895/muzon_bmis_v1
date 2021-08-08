<?php 
session_start(); // Starting Session
include ('../database/db_config.php');

$query = "SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID";
$sql = mysqli_query($conn,$query);

$Total_resident = mysqli_num_rows($sql);



$sql = mysqli_query($conn,"SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'Maternal and Newborn' ");

$Total_NewBorn = mysqli_num_rows($sql);
$sql = mysqli_query($conn,"    SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'Babies' ");

$Total_Babies = mysqli_num_rows($sql);
$sql = mysqli_query($conn,"    SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'Toddlers' ");

$Total_Toddlers = mysqli_num_rows($sql);
$sql = mysqli_query($conn,"    SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'Preschoolers' ");

$Total_Preschoolers = mysqli_num_rows($sql);
$sql = mysqli_query($conn,"    SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'School Age Children' ");
$Total_SAC = mysqli_num_rows($sql);
$sql = mysqli_query($conn,"    SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'Tweens' ");
$Total_Tweens = mysqli_num_rows($sql);
$sql = mysqli_query($conn,"    SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'Teenager' ");
$Total_Teenager = mysqli_num_rows($sql);
$sql = mysqli_query($conn,"    SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'Young Adult' ");
$Total_Young_Adult = mysqli_num_rows($sql);
$sql = mysqli_query($conn,"    SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'Middle-Aged' ");
$Total_MiddleAged = mysqli_num_rows($sql);
$sql = mysqli_query($conn,"    SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID HAVING Age_Stage = 'Senior' ");
$Total_Senior = mysqli_num_rows($sql);

//Set Data here
$response = array(
    'totalResidence' => $Total_resident,
    'totalNewBorn' => $Total_NewBorn,
    'totalBabies' => $Total_Babies,
    'totalToddlers' => $Total_Toddlers,
    'totalPreschoolers' => $Total_Preschoolers,
    'totalSACS' => $Total_SAC,
    'totalTwins' => $Total_Tweens,
    'totalTeenager' => $Total_Teenager,
    'totalYoungAdult' => $Total_Young_Adult,
    'totalMiddleAged' => $Total_MiddleAged,
    'totalSenior' => $Total_Senior
    );


echo json_encode($response);

?>