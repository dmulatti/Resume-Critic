<?php
include_once 'header.php';

$sent = false;

require ('assets/recaptcha/autoload.php');
include_once('assets/recaptcha/secret.php'); //produces $secret

$recaptcha = new \ReCaptcha\ReCaptcha($secret);

$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
if (!$resp->isSuccess()) {
    $errors = $resp->getErrorCodes();
    die('Captcha not verified!');
}



//Remove special characters from $name if they get through the
//jquery check somehow, make sure $email is valid, and
//$message's str_replace recommended as per PHP docs
$name = preg_replace('/[^A-Za-z0-9\ ]/', '', $_POST['contactName']);
$email = filter_var($_POST['contactEmail'], FILTER_VALIDATE_EMAIL);
$message = str_replace("\n.", "\n..", $_POST['contactMessage']);


// NOTE: Most code here is borrowed from Paul Preney
// NOTE: We will wrap $form_msg into a basic HTML5 document to help tidy...
$message = '<!DOCTYPE html><head><title></title></head><body>'.$message.'</body></html>';

$tidy =
  tidy_parse_string(
    $message,
    array(
      'clean' => true,
      'doctype' => 'auto',
      'output-xhtml' => true,
      'show-body-only' => true,
      'drop-empty-paras' => true,
      'drop-font-tags' => true,
      'drop-proprietary-attributes' => true,
      'wrap' => 0,
    ),
    'UTF8'  // Use UTF-8 encoding.
  )
;

// Clean up the parsed document...
$tidy->cleanRepair();

// Before pumping $tidy->Body()->value into the XSLT processor, first
// place the contents within the <body> tag into a string surrounded
// by a <div> tag...
$almost_clean = '<div>'.$tidy->value.'</div>';

// Load the XSLT processor and the the XSL script...
$xsldoc = new DOMDocument();
$xsldoc->load('contact_clean.xsl');

$xslproc = new XSLTProcessor();
$xslproc->importStyleSheet($xsldoc);

// Load up the document to be processed as a DOMDocument...
$doc = new DOMDocument();
// See: http://php.net/manual/en/class.domdocument.php
// If from a file, use $doc->load('filename.xml');
// If XML/XHTML, use...
$doc->loadHTML($almost_clean);

// Invoke the XSLTProcessor and output the results...

$message = $xslproc->transformToXML($doc);


$to = "mulatti@uwindsor.ca";
$subject = "Resume Critic Contact Form";
$headers = "From: $name <$email>\r\nReply-To: $email\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if ($email != false){
    if (mail ($to, $subject, $message, $headers))
        $sent = true;
    else
        $sent = false;
    }
?>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">


        <?php if ($sent): ?>
            <!-- Page Heading -->
            <div class="text-center">
                <h1>Thank you!</h1>
            </div>
            <hr>

            <p class="lead text-center">
                Thanks for your feedback! Your message has been sent, and you
                should hear back from us shortly.
            </p>

        <?php else: ?>
            <!-- Page Heading -->
            <div class="text-center">
                <h1>Oh no!</h1>
            </div>
            <hr>

            <p class="lead text-center">
                We couldn't send your message. Please try again, or email one
                of the admins directly.
            </p>
        <?php endif; ?>

        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->






<?php include_once 'footer.php'; ?>
