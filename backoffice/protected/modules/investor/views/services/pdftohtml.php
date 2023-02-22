
    <title>PDF To HTML Extraction Results</title>


<?php 
// Note: If you have input files large than 200kb we highly recommend to check "async" mode example.

// Get submitted form data
$apiKey = 'ansari.iqbal@in.ey.com_d9ce0992c3eef762befbb27a8605e32a2f8183d9b205a02823c3e967161b79db4c8e1199'; // The authentication key (API Key). Get your own by registering at https://app.pdf.co/documentation/api

$pages = '1';
$plainHtml = 'true';
$columnLayout = 'true';

$url = "https://api.pdf.co/v1/pdf/convert/to/html";
        
    // Prepare requests params
    $parameters = array();
    $filePath = Yii::app()->basePath .'/uploads/default_aaplication_details/205/47.0/NCLT_Petition___GOLDMAX Final.pdf';
    //echo $filePath;
    $parameters["url"] = $filePath; 
    /*$parameters["pages"] = $pages;
    $parameters["simple"] = $plainHtml;
    $parameters["columns"] = $columnLayout;*/

    // Create Json payload
    $data = json_encode($parameters);

    // Create request
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    // Execute request
    $result = curl_exec($curl);
    
    if (curl_errno($curl) == 0)
    {
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if ($status_code == 200)
        {
            $json = json_decode($result, true);
            
            if ($json["error"] == false)
            {
                $resultFileUrl = $json["url"];
                
                // Display link to the file with conversion results
                echo "<div><h2>Conversion Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
            }
            else
            {
                // Display service reported error
                echo "<p>Error: " . $json["message"] . "</p>"; 
            }
        }
        else
        {
            // Display request error
            echo "<p>Status code: " . $status_code . "</p>"; 
            echo "<p>" . $result . "</p>"; 
        }
    }
    else
    {
        // Display CURL error
        echo "Error: " . curl_error($curl);
    }
    
    // Cleanup
    curl_close($curl);
?>

