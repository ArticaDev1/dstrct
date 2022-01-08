<?php namespace Arctica\Projects\Models;

use Arctica\Projects\Models\Attribute;
use Illuminate\Support\Collection;
use October\Rain\Database\Attach\File;
use October\Rain\Database\Model;

/**
 * Model
 */
class Project extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'arctica_projects_projects';

    protected $jsonable = ['project_attributes'];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $attachOne = [
        'schema_image' => 'System\Models\File',
    ];

    public $attachMany = [
        'images' => 'System\Models\File',
    ];

    public $hasMany = [
        'attributes' => [
            ProjectAttributes::class
        ]
    ];

    /**
     * @return Collection
     */
    public function getProjectAttributes(): Collection
    {
        return ProjectAttributes::where('project_id', $this->id)->get();
    }

    /**
     * @return Collection
     */
    public function getProjectImportants(): Collection
    {
        return ProjectImportant::where('project_id', $this->id)->get();
    }

    /**
     * @return mixed
     */
    public function getAttributeIdOptions()
    {
        $notChoosingAttributes = Attribute::whereNotIn(
            'id',
            $this->getProjectAttributes()->map(
                function (ProjectAttributes $attributes): int {
                    return $attributes->getAttributeModel()->id;
                }
            )
        )->get();

        foreach ($notChoosingAttributes as $attribute) {
            $result[$attribute->id] = $attribute->name;
        }

        return $result ?? [];
    }

    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * Отдает полную инфу на фронт
     *
     * @return array
     */
    public function getView(): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'schema_image' => is_null($this->schema_image) ? null : $this->schema_image->getPath(),
            'images' => $this->getImages()->map(
                function (File $file): string {
                    return $file->getPath();
                }
            )->toArray(),
            'attributes' => $this->getProjectAttributes()->map(
                function (ProjectAttributes $attribute): array {
                    return $attribute->getShortView();
                }
            )->toArray(),
            'important' => $this->getProjectImportants()->map(
                function (ProjectImportant $attribute): string {
                    return $attribute->getView();
                }
            )->toArray(),
        ];
    }

    /**
     * @return Collection
     */
    public function getProjectAttributeInPreview(): Collection
    {
        return $this->getProjectAttributes()->filter(
            function (ProjectAttributes $attribute): bool {
                return $attribute->getAttributeModel()->is_preview;
            }
        );
    }

    /**
     * @return array
     */
    public function getPreview(): array
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'preview_attributes' => array_values(
                $this->getProjectAttributeInPreview()->map(
                    function (ProjectAttributes $attribute): array {
                        return $attribute->getShortView();
                    }
                )->toArray()
            ),
            'preview_images' => $this->getImages()->slice(0,2)->map(
                function (File $file): string {
                    return $file->getPath();
                }
            )->toArray(),
        ];
    }

    public function afterCreate()
    {
        $existedAttributes = $this->getProjectAttributes();


        foreach ($this->project_attributes as $projectAttribute) {
            $attributeId = $projectAttribute['attribute_id'];
            $attributeValue = $projectAttribute['value'];

            $existedProjectAttribute = $existedAttributes->filter(
                function (ProjectAttributes $projectAttribute) use ($attributeId): bool {
                    return $projectAttribute->getAttributeModel()->id == $attributeId;
                }
            )->first();

            $attributeModel = Attribute::where('id', $attributeId)->get()->first();

            if (is_null($existedProjectAttribute)) {
                $model = new ProjectAttributes();

                $model->value = $attributeValue;
                $model->setRelation('attribute', $attributeModel);
                $model->setRelation('project', $this);

                $model->save();

                $this->getProjectAttributes()->add($model);
            } else {
                $existedProjectAttribute->value = $attributeValue;

                $existedProjectAttribute->save();
            }
        }

        parent::afterCreate();
    }
}
