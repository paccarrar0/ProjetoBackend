<?php

namespace App\Services;

use Core\Constants\Constants;
use Core\Database\ActiveRecord\Model;

/**
 * @property string $image_path
 */

class EquipmentImage
{
    /** @var array<string, mixed> $image */
    private array $image;

    public function __construct(
        private Model $model
    ) {
    }

    public function path(): string
    {
        if ($this->model->image_path !== null) {
            return $this->baseDir() . $this->model->image_path;
        }

        return "/assets/images/defaults/default.png";
    }

    /**
     * @param array<string, mixed> $image
     */
    public function update(array $image): bool
    {
        $this->image = $image;

        if (!$this->isValidImage($image)) {
            return false;
        }

        if (!empty($this->getTmpFilePath())) {
            $this->removeOldImage();
            $this->model->update(['image_path' => $this->getFileName()]);
            move_uploaded_file($this->getTmpFilePath(), $this->getAbsoluteFilePath());
            return true;
        }
        return false;
    }

    private function getTmpFilePath(): string
    {
        return $this->image['tmp_name'];
    }

    private function removeOldImage(): void
    {
        if ($this->model->image_path) {
            $path = Constants::rootPath()->join('public' . $this->baseDir())->join($this->model->image_path);
            unlink($path);
        }
    }

    private function getFileName(): string
    {
        $file_name_splitted  = explode('.', $this->image['name']);
        $file_extension = end($file_name_splitted);
        return 'equipment.' . $file_extension;
    }

    private function getAbsoluteFilePath(): string
    {
        return $this->storeDir() . $this->getFileName();
    }

    private function baseDir(): string
    {
        return "/assets/uploads/{$this->model::table()}/{$this->model->id}/";
    }

    private function storeDir(): string
    {
        $path = Constants::rootPath()->join('public' . $this->baseDir());
        if (!is_dir($path)) {
            mkdir(directory: $path, recursive: true);
        }

        return $path;
    }

    public function delete(): void
    {
        if ($this->model->image_path) {
            $path = Constants::rootPath()->join('public' . $this->baseDir())->join($this->model->image_path);

            if (file_exists($path)) {
                unlink($path);
            }

            $this->model->update(['image_path' => null]);

            $this->removeEmptyDirectory();
        }
    }

    private function removeEmptyDirectory(): void
    {
        $directory = Constants::rootPath()->join('public' . $this->baseDir());

        if (is_dir($directory) && count(scandir($directory)) === 2) {
            rmdir($directory);
        }
    }

    /**
     * @param array<string> $image
     */

    private function isValidImage(array $image): bool
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        $maxFileSize = 5 * 1024 * 1024;

        if (
            !in_array($image['type'], $allowedMimeTypes, true)
            ||
            !in_array($fileExtension, $allowedExtensions, true)
        ) {
            return false;
        }

        if ($image['size'] > $maxFileSize) {
            return false;
        }

        return true;
    }
}
