<?php

namespace AlifAhmmed\HelperPackage\Traits;

trait AllTraits
{
    use ApiResponse, DatabaseExportable, FileManager, HasFilter, ImagePathTrait, TableAction, TestPerpose, UnitConverter, SlugGenerator;
}
