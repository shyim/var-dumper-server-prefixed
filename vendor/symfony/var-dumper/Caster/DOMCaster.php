<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster;

use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * Casts DOM related classes to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class DOMCaster
{
    private static $errorCodes = [\DOM_PHP_ERR => 'DOM_PHP_ERR', \DOM_INDEX_SIZE_ERR => 'DOM_INDEX_SIZE_ERR', \DOMSTRING_SIZE_ERR => 'DOMSTRING_SIZE_ERR', \DOM_HIERARCHY_REQUEST_ERR => 'DOM_HIERARCHY_REQUEST_ERR', \DOM_WRONG_DOCUMENT_ERR => 'DOM_WRONG_DOCUMENT_ERR', \DOM_INVALID_CHARACTER_ERR => 'DOM_INVALID_CHARACTER_ERR', \DOM_NO_DATA_ALLOWED_ERR => 'DOM_NO_DATA_ALLOWED_ERR', \DOM_NO_MODIFICATION_ALLOWED_ERR => 'DOM_NO_MODIFICATION_ALLOWED_ERR', \DOM_NOT_FOUND_ERR => 'DOM_NOT_FOUND_ERR', \DOM_NOT_SUPPORTED_ERR => 'DOM_NOT_SUPPORTED_ERR', \DOM_INUSE_ATTRIBUTE_ERR => 'DOM_INUSE_ATTRIBUTE_ERR', \DOM_INVALID_STATE_ERR => 'DOM_INVALID_STATE_ERR', \DOM_SYNTAX_ERR => 'DOM_SYNTAX_ERR', \DOM_INVALID_MODIFICATION_ERR => 'DOM_INVALID_MODIFICATION_ERR', \DOM_NAMESPACE_ERR => 'DOM_NAMESPACE_ERR', \DOM_INVALID_ACCESS_ERR => 'DOM_INVALID_ACCESS_ERR', \DOM_VALIDATION_ERR => 'DOM_VALIDATION_ERR'];
    private static $nodeTypes = [\XML_ELEMENT_NODE => 'XML_ELEMENT_NODE', \XML_ATTRIBUTE_NODE => 'XML_ATTRIBUTE_NODE', \XML_TEXT_NODE => 'XML_TEXT_NODE', \XML_CDATA_SECTION_NODE => 'XML_CDATA_SECTION_NODE', \XML_ENTITY_REF_NODE => 'XML_ENTITY_REF_NODE', \XML_ENTITY_NODE => 'XML_ENTITY_NODE', \XML_PI_NODE => 'XML_PI_NODE', \XML_COMMENT_NODE => 'XML_COMMENT_NODE', \XML_DOCUMENT_NODE => 'XML_DOCUMENT_NODE', \XML_DOCUMENT_TYPE_NODE => 'XML_DOCUMENT_TYPE_NODE', \XML_DOCUMENT_FRAG_NODE => 'XML_DOCUMENT_FRAG_NODE', \XML_NOTATION_NODE => 'XML_NOTATION_NODE', \XML_HTML_DOCUMENT_NODE => 'XML_HTML_DOCUMENT_NODE', \XML_DTD_NODE => 'XML_DTD_NODE', \XML_ELEMENT_DECL_NODE => 'XML_ELEMENT_DECL_NODE', \XML_ATTRIBUTE_DECL_NODE => 'XML_ATTRIBUTE_DECL_NODE', \XML_ENTITY_DECL_NODE => 'XML_ENTITY_DECL_NODE', \XML_NAMESPACE_DECL_NODE => 'XML_NAMESPACE_DECL_NODE'];
    public static function castException(\DOMException $e, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $k = \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_PROTECTED . 'code';
        if (isset($a[$k], self::$errorCodes[$a[$k]])) {
            $a[$k] = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub(self::$errorCodes[$a[$k]], $a[$k]);
        }
        return $a;
    }
    public static function castLength($dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['length' => $dom->length];
        return $a;
    }
    public static function castImplementation($dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'Core' => '1.0', \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'XML' => '2.0'];
        return $a;
    }
    public static function castNode(\DOMNode $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['nodeName' => $dom->nodeName, 'nodeValue' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->nodeValue), 'nodeType' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub(self::$nodeTypes[$dom->nodeType], $dom->nodeType), 'parentNode' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->parentNode), 'childNodes' => $dom->childNodes, 'firstChild' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->firstChild), 'lastChild' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->lastChild), 'previousSibling' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->previousSibling), 'nextSibling' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->nextSibling), 'attributes' => $dom->attributes, 'ownerDocument' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->ownerDocument), 'namespaceURI' => $dom->namespaceURI, 'prefix' => $dom->prefix, 'localName' => $dom->localName, 'baseURI' => $dom->baseURI ? new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\LinkStub($dom->baseURI) : $dom->baseURI, 'textContent' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->textContent)];
        return $a;
    }
    public static function castNameSpaceNode(\DOMNameSpaceNode $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['nodeName' => $dom->nodeName, 'nodeValue' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->nodeValue), 'nodeType' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub(self::$nodeTypes[$dom->nodeType], $dom->nodeType), 'prefix' => $dom->prefix, 'localName' => $dom->localName, 'namespaceURI' => $dom->namespaceURI, 'ownerDocument' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->ownerDocument), 'parentNode' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->parentNode)];
        return $a;
    }
    public static function castDocument(\DOMDocument $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested, $filter = 0)
    {
        $a += ['doctype' => $dom->doctype, 'implementation' => $dom->implementation, 'documentElement' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($dom->documentElement), 'actualEncoding' => $dom->actualEncoding, 'encoding' => $dom->encoding, 'xmlEncoding' => $dom->xmlEncoding, 'standalone' => $dom->standalone, 'xmlStandalone' => $dom->xmlStandalone, 'version' => $dom->version, 'xmlVersion' => $dom->xmlVersion, 'strictErrorChecking' => $dom->strictErrorChecking, 'documentURI' => $dom->documentURI ? new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\LinkStub($dom->documentURI) : $dom->documentURI, 'config' => $dom->config, 'formatOutput' => $dom->formatOutput, 'validateOnParse' => $dom->validateOnParse, 'resolveExternals' => $dom->resolveExternals, 'preserveWhiteSpace' => $dom->preserveWhiteSpace, 'recover' => $dom->recover, 'substituteEntities' => $dom->substituteEntities];
        if (!($filter & \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE)) {
            $formatOutput = $dom->formatOutput;
            $dom->formatOutput = \true;
            $a += [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'xml' => $dom->saveXML()];
            $dom->formatOutput = $formatOutput;
        }
        return $a;
    }
    public static function castCharacterData(\DOMCharacterData $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['data' => $dom->data, 'length' => $dom->length];
        return $a;
    }
    public static function castAttr(\DOMAttr $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['name' => $dom->name, 'specified' => $dom->specified, 'value' => $dom->value, 'ownerElement' => $dom->ownerElement, 'schemaTypeInfo' => $dom->schemaTypeInfo];
        return $a;
    }
    public static function castElement(\DOMElement $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['tagName' => $dom->tagName, 'schemaTypeInfo' => $dom->schemaTypeInfo];
        return $a;
    }
    public static function castText(\DOMText $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['wholeText' => $dom->wholeText];
        return $a;
    }
    public static function castTypeinfo(\DOMTypeinfo $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['typeName' => $dom->typeName, 'typeNamespace' => $dom->typeNamespace];
        return $a;
    }
    public static function castDomError(\DOMDomError $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['severity' => $dom->severity, 'message' => $dom->message, 'type' => $dom->type, 'relatedException' => $dom->relatedException, 'related_data' => $dom->related_data, 'location' => $dom->location];
        return $a;
    }
    public static function castLocator(\DOMLocator $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['lineNumber' => $dom->lineNumber, 'columnNumber' => $dom->columnNumber, 'offset' => $dom->offset, 'relatedNode' => $dom->relatedNode, 'uri' => $dom->uri ? new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\LinkStub($dom->uri, $dom->lineNumber) : $dom->uri];
        return $a;
    }
    public static function castDocumentType(\DOMDocumentType $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['name' => $dom->name, 'entities' => $dom->entities, 'notations' => $dom->notations, 'publicId' => $dom->publicId, 'systemId' => $dom->systemId, 'internalSubset' => $dom->internalSubset];
        return $a;
    }
    public static function castNotation(\DOMNotation $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['publicId' => $dom->publicId, 'systemId' => $dom->systemId];
        return $a;
    }
    public static function castEntity(\DOMEntity $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['publicId' => $dom->publicId, 'systemId' => $dom->systemId, 'notationName' => $dom->notationName, 'actualEncoding' => $dom->actualEncoding, 'encoding' => $dom->encoding, 'version' => $dom->version];
        return $a;
    }
    public static function castProcessingInstruction(\DOMProcessingInstruction $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['target' => $dom->target, 'data' => $dom->data];
        return $a;
    }
    public static function castXPath(\DOMXPath $dom, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += ['document' => $dom->document];
        return $a;
    }
}
