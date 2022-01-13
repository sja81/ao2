<?php
namespace common\models\documents\templatedocuments;

abstract class TemplateDocument
{
    protected $templateData = [];
    protected $templateContent = null;
    protected $templateContentStore = null;
    protected $fileNameTemplate = null;
    protected $fileName = null;

    public function setTemplateContent(string $content): void
    {
        $this->templateContent = $content;
        $this->templateContentStore = $content;
    }

    public function getTemplateContent(): string
    {
        return $this->templateContent;
    }

    public function setTemplateData(array $templateData): void
    {
        $this->templateData = $templateData;
    }

    public function setFileNameTemplate(string $template): void
    {
        $this->fileNameTemplate = $template;
    }

    abstract public function create(): void;
    abstract public function writeToFile(): void;
    abstract public function downloadFile(): void;

}