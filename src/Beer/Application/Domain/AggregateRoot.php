<?php

namespace App\Beer\Application\Domain;

abstract class AggregateRoot
{

    final public function toArray(): array
    {
        $array = [];

        foreach (get_class_methods($this) as $functionName) {
            if ($this->isValidFunction($functionName)) {
                $array[$functionName] = $this->getValue($this, $functionName);
            }
        }

        return $array;
    }

    private function getValue(AggregateRoot $object, string $functionName): mixed
    {
        if ('id' === $functionName || 'value' === $functionName) {
            return $object->$functionName();
        }

        if (is_object($object->$functionName())) {
            foreach (get_class_methods($object->$functionName()) as $subFunctionName) {
                if ('value' === $subFunctionName) {
                    return $object->$functionName()->$subFunctionName();
                }
            }
        }

        return null;
    }

    private function isValidFunction(string $functionName): bool
    {
        return !in_array($functionName, [
            '__construct',
            '__toString',
            'getValue',
            'isValidFunction',
            'password',
            'record',
            'toArray',
        ]);
    }
}