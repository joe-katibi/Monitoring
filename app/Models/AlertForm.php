<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Creagia\LaravelSignPad\Concerns\RequiresSignature;
use Creagia\LaravelSignPad\Contracts\CanBeSigned;
use Creagia\LaravelSignPad\Contracts\ShouldGenerateSignatureDocument;
use Creagia\LaravelSignPad\Templates\BladeDocumentTemplate;
use Creagia\LaravelSignPad\Templates\PdfDocumentTemplate;
use Creagia\LaravelSignPad\SignatureDocumentTemplate;

class AlertForm extends Model implements CanBeSigned, ShouldGenerateSignatureDocument
{
    use HasFactory;
    use RequiresSignature;
    protected $fillable=[
    'title',
    'date',
    'agent_name',
    'supervisor_name',
    'qa_name',
    'description',
    'fatal_error',
    'supervisor_comment',
    'qa_signature',
    'date_by_qa',
    'supervisor_signature',
    'date_by_supervisor',
    'agent_signature',
    'date_by_agent',

];
protected $casts = [
    'created_at' => 'datetime:d-M-Y'
];

public function getSignatureDocumentTemplate(): SignatureDocumentTemplate
{
    return new SignatureDocumentTemplate(
        signaturePage: 1,
        signatureX: 20,
        signatureY: 25,
        outputPdfPrefix: 'document', // optional
        // template: new BladeDocumentTemplate('pdf/my-pdf-blade-template'), // Uncomment for Blade template
        // template: new PdfDocumentTemplate(storage_path('pdf/template.pdf')), // Uncomment for PDF template
    );
}

}
