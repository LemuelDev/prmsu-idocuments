<?php

namespace App\Http\Controllers;

use App\Models\RequestedDocument;
use Carbon\Carbon;
use Exception;
use setasign\Fpdi\Tcpdf\Fpdi;
use TCPDF;

class PdfController extends Controller
{ 
    public function downloadForm(RequestedDocument $id)
    {
        $userProfile = $id->userProfile;
        $data = [
            'firstname' => $userProfile->firstname,
            'middlename' => $userProfile->middlename,
            'lastname' => $userProfile->lastname,
            'extensionname' => $userProfile->extensionname,
            'name' => $userProfile->name,
            'sex' => $userProfile->sex,
            'age' => $userProfile->age,
            'birthday' => Carbon::parse($userProfile->birthday)->format('F j, Y'),
            'course' => $userProfile->course,
            'phone_number' => $userProfile->phone_number,
            'email' => $userProfile->email,
            'year' => $userProfile->year,
            'address' => $userProfile->address,
            'student_number' => $userProfile->student_number,
            'birthplace' => $userProfile->birthplace,
            'date_requested' => $id->created_at->format('F j, Y'),
            'check_correction'=> $id->check_correction,
            'orig_name' => $id->orig_name,
            'check_graduate' => $id->check_graduate,
            'last_term' => $id->last_term,
            'last_school_year' => $id->last_school_year,
            'requested_document' => $id->requested_document,
            'copies_orig' => $id->copies_orig,
            'copies_ctc' => $id->copies_ctc,
            'purpose' => $id->purpose,
        ];
    
      // Path to your PDF template
        $templatePath = storage_path('app/template/request_document_format.pdf'); // Adjust path as needed

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($templatePath);

        for ($i = 1; $i <= $pageCount; $i++) {
        $tplId = $pdf->importPage($i);
        
        // Set page size and orientation (assuming A4 portrait for this example)
        $size = $pdf->getTemplateSize($tplId);
        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
        
        $pdf->useTemplate($tplId, 0, 0);
    
            if ($i == 1) { // Adjust this condition based on which page you want to fill data on
                $pdf->SetFont('Helvetica', '', 9);
                
                // Set text to be written to PDF
                $pdf->SetXY(19, 52); $pdf->Write(0, $data['firstname']);
                $pdf->SetXY(78, 52); $pdf->Write(0, $data['middlename'] ?? '');
                $pdf->SetXY(120, 52); $pdf->Write(0, $data['lastname']);
                $pdf->SetXY(170, 52); $pdf->Write(0, $data['extensionname'] ?? '');
                $pdf->SetXY(85, 65); $pdf->Write(0, $data['birthday']);
                $pdf->SetXY(135, 65); $pdf->Write(0, $data['birthplace']);
                $pdf->SetXY(50, 89); $pdf->Write(0, $data['student_number']);
                $pdf->SetXY(74, 123); $pdf->Write(0, $data['phone_number']);
                $pdf->SetXY(138, 123); $pdf->Write(0, $data['email']);
                $pdf->SetXY(70, 130); $pdf->Write(0, $data['address']);
                $pdf->SetXY(95, 144); $pdf->Write(0, $data['date_requested']);
                $pdf->SetXY(155, 111); $pdf->Write(0, $data['last_school_year'] ?? '');
                $pdf->SetXY(90, 73); $pdf->Write(0, $data['orig_name'] ?? '');

                $pdf->SetFont('Helvetica', '', 7);
                $pdf->SetXY(133, 89); $pdf->Write(0, $data['course']);

                  // Add check mark based on sex
                $pdf->SetFont('DejaVuSans', '', 14);
                if ($data['sex'] == 'male') {
                    $pdf->SetXY(23, 63); $pdf->Write(0, '✓'); 
                } else {
                    $pdf->SetXY(45, 63); $pdf->Write(0, '✓'); 
                }

                if ($data['check_correction'] == 'No') {
                    $pdf->SetXY(18, 73); $pdf->Write(0,  '✓');
                } else {
                    $pdf->SetXY(33, 73); $pdf->Write(0,  '✓');
                }

                if ($data['check_graduate'] == 'No') {
                    $pdf->SetXY(17, 106); $pdf->Write(0,  '✓');

                    if ($data['last_term'] == '1') {
                        $pdf->SetXY(109, 106); $pdf->Write(0, '✓');
                    } elseif($data['last_term'] == '2') {
                        $pdf->SetXY(125, 106); $pdf->Write(0, '✓');
                    }elseif($data['last_term'] == '3')  {
                        $pdf->SetXY(141, 106); $pdf->Write(0, '✓');
                    }else {
                        $pdf->SetXY(158, 106); $pdf->Write(0, '✓');
                    }

                } else {
                    $pdf->SetXY(17, 102); $pdf->Write(0,  '✓');
                }

                if($data["requested_document"] === "Certificate of Enrollment" 
                || $data["requested_document"] === "Certificate of Grades" 
                || $data["requested_document"] === "Certificate of GWA"
                || $data["requested_document"] === "Certificate of Academic Completion"
                || $data["requested_document"] === "Certificate of Graduation"
                || $data["requested_document"] === "Certificate of Candidate for Graduation"
                || $data["requested_document"] === "Certificate of Honor Graduate"
                || $data["requested_document"] === "Certificate of English as Intruction"
                || $data["requested_document"] === "Certificate of Course Description") {
                    
                    $pdf->SetXY(13, 250); $pdf->Write(0,  '✓');
                    $pdf->SetXY(12, 236); $pdf->Write(0,  '✓');
                    $pdf->SetXY(180, 239); $pdf->Write(0,  $data["copies_orig"]);
                    $pdf->SetXY(180, 250); $pdf->Write(0,  $data["copies_ctc"]);

                    $pdf->SetFont('Helvetica', '', 9);
                    $pdf->SetXY(20, 250); $pdf->Write(0,  $data["requested_document"]);
                    $pdf->SetXY(20, 239); $pdf->Write(0,  $data["requested_document"]);
                    $pdf->SetXY(100, 239); $pdf->Write(0,  $data["purpose"]);
                    $pdf->SetXY(100, 250); $pdf->Write(0,  $data["purpose"]);

                }elseif ($data["requested_document"] === "Transcript of Records" ){

                    $pdf->SetXY(13, 198); $pdf->Write(0,  '✓');
                    $pdf->SetXY(180, 198); $pdf->Write(0,  $data["copies_orig"]);
                    $pdf->SetFont('Helvetica', '', 9);
                    $pdf->SetXY(120, 200); $pdf->Write(0,  $data["purpose"]);
                }elseif ($data["requested_document"] === "Original Diploma" ){
                    
                    $pdf->SetXY(13, 207); $pdf->Write(0,  '✓');
                    $pdf->SetXY(180, 207); $pdf->Write(0,  $data["copies_orig"]);
                    $pdf->SetFont('Helvetica', '', 9);
                    $pdf->SetXY(120, 207); $pdf->Write(0,  $data["purpose"]);
                }
                elseif ($data["requested_document"] === "Copy of Diploma" ){
                    
                    $pdf->SetXY(48, 207); $pdf->Write(0,  '✓');
                    $pdf->SetXY(180, 207); $pdf->Write(0,  $data["copies_orig"]);
                    $pdf->SetFont('Helvetica', '', 9);
                    $pdf->SetXY(120, 207); $pdf->Write(0,  $data["purpose"]);
                } elseif ($data["requested_document"] === "Form 137" ){
                    
                    $pdf->SetXY(13, 214); $pdf->Write(0,  '✓');
                    $pdf->SetXY(180, 214); $pdf->Write(0,  $data["copies_orig"]);
                    $pdf->SetFont('Helvetica', '', 9);
                    $pdf->SetXY(120, 214); $pdf->Write(0,  $data["purpose"]);
                } elseif ($data["requested_document"] === "Related Learning Experience" ){

                    $pdf->SetXY(12, 221); $pdf->Write(0,  '✓');
                    $pdf->SetXY(180, 221); $pdf->Write(0,  $data["copies_orig"]);
                    $pdf->SetFont('Helvetica', '', 9);
                    $pdf->SetXY(120, 221); $pdf->Write(0,  $data["purpose"]);

                }elseif ($data["requested_document"] === "CAV" ){
                    
                    $pdf->SetXY(13, 228); $pdf->Write(0,  '✓');
                    $pdf->SetXY(180, 229); $pdf->Write(0,  $data["copies_orig"]);
                    $pdf->SetFont('Helvetica', '', 9);
                    $pdf->SetXY(120, 229); $pdf->Write(0,  $data["purpose"]);
                }
                
            }

            if ($i == 2) {
                $pdf->SetFont('Helvetica', '', 9);
                $pdf->SetXY(93, 215); $pdf->Write(0, $data['name']);
                $pdf->SetXY(75, 204); $pdf->Write(0, $data['name']);
                $pdf->SetXY(85, 268); $pdf->Write(0, $data['name']);
            }
        }
    
        // Output path
        $outputPath = public_path('files/filled_request_document.pdf');
        $outputPath = str_replace('\\', '/', $outputPath);
    
        try {
            $pdf->Output($outputPath, 'F'); // Save to file
            return response()->download($outputPath); // Serve the file for download
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}