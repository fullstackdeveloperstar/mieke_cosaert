<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Contact extends CI_Controller
{
	/**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
    	$data['categories'] = $this->category_model->getCategories();
    	$data['sent'] = $this->input->get("mess");
        $this->load->view('contents/header_view', $data);
        $this->load->view('Contact', $data);
        $this->load->view('contents/footer_view');
    }

    public function send(){
        $this->load->library('email');
        $this->load->library('form_validation');
    
        //Set form validation
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[6]|max_length[60]');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[12]|max_length[200]');
    
        //Run form validation
        if ($this->form_validation->run() === FALSE)
        {
            // $this->load->view('contact');
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Problem in Validation</div>');
            redirect('contact');
        } else {
    
            //Get the form data
            $name = $this->input->post('first_name').' ' . $this->input->post('last_name');
            $from_email = $this->input->post('email');
            $subject = 'Aanvraag tot informatie';//$this->input->post('subject');
            $message = $this->input->post('message');
    
            //Web master email
            $to_email = 'mieke@miekecosaert.be'; //Webmaster email, who receive mails
    
            //Mail settings
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'mail.authsmtp.com';
            $config['smtp_port'] = '2525';
            $config['smtp_user'] = 'ac46055'; // Your email address
            $config['smtp_pass'] = 'ceba3ppvb'; // Your email account password
            $config['mailtype'] = 'html'; // or 'text'
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE; //No quotes required
            $config['newline'] = "\r\n"; //Double quotes required
    
            $this->email->initialize($config);                        
    
            //Send mail with data
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);
            
            if ($this->email->send())
            {
                $this->session->set_flashdata('msg','<div class="alert alert-success">Mail sent!</div>');
    
                // redirect('contact');
            } else {
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Problem in sending</div>');
                // $this->load->view('contact');
                // redirect('contact');
            }
        }
    }

    public function sendMailer() {
        $this->load->library('form_validation');
    
        //Set form validation
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
    
        //Run form validation
        if ($this->form_validation->run() === FALSE)
        {
            // $this->load->view('contact');
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Problem in Validation</div>');
            redirect('contact');
        } else {
    
            
            $first_name = $this->input->post('first_name'); 
            $last_name = $this->input->post('last_name');
            $from_email = $this->input->post('email');
            $subject = 'Aanvraag tot informatie';//$this->input->post('subject');
            $message = $this->input->post('message');
    


            $mail = new PHPMailer(true);

            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'mail.authsmtp.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'ac46055';                     // SMTP username
                $mail->Password   = 'ceba3ppvb';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 2525;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                //Recipients
                $mail->setFrom('no-reply@iparticipate.be', 'from website <no-reply@iparticipate.be>');
                // $mail->addAddress('gilles.capelluto@prodigious.be', 'Mieke');
                // $mail->addAddress('mieke@miekecosaert.be', 'Mieke');
                $mail->addAddress('rubby.star.sg@gmail.com', 'Mieke');
               
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Aanvraag tot informatie';
                $mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:arial, "helvetica neue", helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
                 <head> 
                  <meta charset="UTF-8"> 
                  <meta content="width=device-width, initial-scale=1" name="viewport"> 
                  <meta name="x-apple-disable-message-reformatting"> 
                  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
                  <meta content="telephone=no" name="format-detection"> 
                  <title>Nouvel e-mail 2</title> 
                  <!--[if (mso 16)]>
                    <style type="text/css">
                    a {text-decoration: none;}
                    </style>
                    <![endif]--> 
                  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
                  <!--[if gte mso 9]>
                <xml>
                    <o:OfficeDocumentSettings>
                    <o:AllowPNG></o:AllowPNG>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                </xml>
                <![endif]--> 
                  <!--[if !mso]><!-- --> 
                  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700,700i" rel="stylesheet"> 
                  <!--<![endif]--> 
                  <style type="text/css">
                #outlook a {
                    padding:0;
                }
                .ExternalClass {
                    width:100%;
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                    line-height:100%;
                }
                .es-button {
                    mso-style-priority:100!important;
                    text-decoration:none!important;
                }
                a[x-apple-data-detectors] {
                    color:inherit!important;
                    text-decoration:none!important;
                    font-size:inherit!important;
                    font-family:inherit!important;
                    font-weight:inherit!important;
                    line-height:inherit!important;
                }
                .es-desk-hidden {
                    display:none;
                    float:left;
                    overflow:hidden;
                    width:0;
                    max-height:0;
                    line-height:0;
                    mso-hide:all;
                }
                @media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } a.es-button, button.es-button { font-size:20px!important; display:block!important; border-width:10px 0px 10px 0px!important } }
                </style> 
                 </head> 
                 <body style="width:100%;font-family:arial, "helvetica neue", helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"> 
                  <div class="es-wrapper-color" style="background-color:#F6F6F6"> 
                   <!--[if gte mso 9]>
                            <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                                <v:fill type="tile" color="#f6f6f6"></v:fill>
                            </v:background>
                        <![endif]--> 
                   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top"> 
                     <tr style="border-collapse:collapse"> 
                      <td valign="top" style="padding:0;Margin:0"> 
                       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0"> 
                           <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px"> 
                             <tr style="border-collapse:collapse"> 
                              <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px"> 
                               <!--[if mso]><table style="width:560px" cellpadding="0"
                                            cellspacing="0"><tr><td style="width:180px" valign="top"><![endif]--> 
                               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:180px"> 
                                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td style="padding:0;Margin:0;font-size:0px" align="center"><img src="https://www.mieke-cosaert.be/assets/images/MiekeLogo_black.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table> 
                               <!--[if mso]></td><td style="width:20px"></td><td style="width:360px" valign="top"><![endif]--> 
                               <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td align="left" style="padding:0;Margin:0;width:360px"> 
                                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td align="center" style="padding:0;Margin:0;padding-top:15px"><h1 style="Margin:0;line-height:25px;mso-line-height-rule:exactly;font-family:"source sans pro", "helvetica neue", helvetica, arial, sans-serif;font-size:21px;font-style:normal;font-weight:normal;color:#333333">From Website<br></h1></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table> 
                               <!--[if mso]></td></tr></table><![endif]--></td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="left" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:35px"> 
                               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td class="es-m-p0r" valign="top" align="center" style="padding:0;Margin:0;width:560px"> 
                                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td align="left" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;color:#333333">First Name :&nbsp; '.$first_name.'<br>Last Name : '.$last_name.'<br>Email : '.$from_email.'<br><br>Bericht :<br>'.$message.'</p></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table></td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td style="padding:10px;Margin:0;background-color:#666666" bgcolor="#666666" align="left"> 
                               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td align="left" style="padding:0;Margin:0;width:580px"> 
                                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td align="left" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:11px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:17px;color:#FFFFFF">'.date("Y/m/d").' @ '.date("h:i:sa").'</p></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table></td> 
                             </tr> 
                           </table></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                   </table> 
                  </div>  
                 </body>
                </html>';
                $mail->AltBody = '';
            
                $mail->send();
                // echo 'Message has been sent';

                $this->session->set_flashdata('msg','<div class="alert alert-success">Mail sent!</div>');
    
               
                $data['categories'] = $this->category_model->getCategories();
                $this->load->view('contents/header_view', $data);
                $this->load->view('Contact');
                $this->load->view('contents/footer_view');
            } catch (Exception $e) {
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Problem in sending</div>');
                
                $data['categories'] = $this->category_model->getCategories();
                $this->load->view('contents/header_view', $data);
                $this->load->view('Contact');
                $this->load->view('contents/footer_view');
            }
        }
    }
    
}
?>