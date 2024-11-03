<?php

namespace App\Http\Controllers;

use App\Models\Sketchpad;
use App\Http\Resources\SketchpadResource;
use App\Http\Resources\SketchpadCollection;
use App\Http\Requests\StoreSketchpadRequest;
use App\Http\Requests\UpdateSketchpadRequest;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use OpenApi\Attributes as OA;


class SketchpadController extends Controller
{

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        description: 'Возвращает перечень записной книжки',
        path: '/api/v1/sketchpads',
        summary: 'Показывает список всех контактов',
    )]
    #[OA\Response(
        content: new OA\JsonContent(),
        description: 'Перечень записной книжки',
        response: 200,
    )]
    #[OA\Response(
        content: new OA\JsonContent(),
        description: 'Контакт в записной книжке не найден',
        response: 404,
    )]

    public function index(Request $request)
    {
        $sketchpad = Sketchpad::all();
        // return response($sketchpad);
        return new SketchpadCollection($sketchpad);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\StoreSketchpadRequest  $request
     * @return \Illuminate\Http\Response
     */
    #[OA\Post(
        path: '/api/v1/sketchpads',
        summary: 'Добавить новый контакт в записную книжку',
        description: 'Создаёт новый контакт в записной книжке',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['FIO', 'telephone', 'email'],
                properties: [
                    new OA\Property(property: 'FIO', type: 'string', maxLength: 200, example: 'Иван Иванов'),
                    new OA\Property(property: 'company', type: 'string', maxLength: 50, example: 'ООО "Ромашка"'),
                    new OA\Property(property: 'telephone', type: 'string', maxLength: 20, example: '+7 (123) 456-78-90'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', maxLength: 100, example: 'example@mail.com'),
                    new OA\Property(property: 'date_of_birth', type: 'string', format: 'date', example: '1990-01-01'),
                    new OA\Property(property: 'photo', type: 'string', maxLength: 100, example: 'filename.jpg'),
                ]
            )
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Запись в записной книжке успешно создана',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'Запись успешно создана'),
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'FIO', type: 'string', example: 'Иван Иванов'),
                new OA\Property(property: 'company', type: 'string', example: 'ООО "Ромашка"'),
                new OA\Property(property: 'telephone', type: 'string', example: '+7 (123) 456-78-90'),
                new OA\Property(property: 'email', type: 'string', example: 'example@mail.com'),
                new OA\Property(property: 'date_of_birth', type: 'string', example: '1990-01-01'),
                new OA\Property(property: 'photo', type: 'string', example: 'filename.jpg'),
            ]
        )
    )]
    public function store(StoreSketchpadRequest $request)
    {
        $data = $request->validated();
        $sketchpad = Sketchpad::create($data);

        return response()->noContent(201)->withHeaders([
            'Location' => route('sketchpads.show', [
                'sketchpad' => $sketchpad->id,
            ]),
        ]);
    }

    /**
     * Display the specified resource.
     * 
     * @param \App\Models\Sketchpad $sketchpad
     * @return \Illuminate\Http\Response
     */

    #[OA\Get(
        path: '/api/v1/sketchpads/{sketchpad}',
        summary: 'Получить запись по идентификатору',
        description: 'Возвращает записную книжку по идентификатору',
        parameters: [
            new OA\Parameter(
                name: 'sketchpad',
                in: 'path',
                required: true,
                description: 'ID записной книжки',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'Запись найдена',
    )]
    #[OA\Response(
        response: 404,
        description: 'Контакт не найден',
    )]
    public function show(Sketchpad $sketchpad)
    {
        return new SketchpadResource($sketchpad);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\UpdateSketchpadRequest $request
     * @param \App\Models\Sketchpad  $sketchpad
     * @return \Illuminate\Http\Response
     */
    #[OA\Patch(
        path: '/api/v1/sketchpads/{sketchpad}',
        summary: 'Обновить запись по идентификатору',
        description: 'Обновляет существующего контакта в записной книжке',
        parameters: [
            new OA\Parameter(
                name: 'sketchpad',
                in: 'path',
                required: true,
                description: 'ID записной книжки',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'FIO', type: 'string', example: 'Иван Иванов'),
                    new OA\Property(property: 'company', type: 'string', example: 'ООО "Ромашка"'),
                    new OA\Property(property: 'telephone', type: 'string', example: '+7 (123) 456-78-90'),
                    new OA\Property(property: 'email', type: 'string', example: 'example@mail.com'),
                    new OA\Property(property: 'date_of_birth', type: 'string', format: 'date', example: '1990-01-01'),
                    new OA\Property(property: 'photo', type: 'string', example: 'filename.jpg'),
                ]
            )
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Запись успешно обновлена',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'Запись успешно обновлена'),
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Запись не найдена',
    )]
    
    public function update(UpdateSketchpadRequest $request, Sketchpad $sketchpad)
    {
        $data = $request->validated();
        $sketchpad->update($data);
        return response()->noContent(204);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param \App\Models\Sketchpad $sketchpad
     * @return \Illuminate\Http\Response
     */
    #[OA\Delete(
        path: '/api/v1/sketchpads/{sketchpad}',
        summary: 'Удалить запись по идентификатору',
        description: 'Удаляет существующую записную книжку',
        parameters: [
            new OA\Parameter(
                name: 'sketchpad',
                in: 'path',
                required: true,
                description: 'ID записной книжки',
                schema: new OA\Schema(type: 'integer')
            ),
        ]
    )]
    #[OA\Response(
        response: 204,
        description: 'Запись успешно удалена'
    )]
    #[OA\Response(
        response: 404,
        description: 'Запись не найдена',
    )]
    public function destroy(Sketchpad $sketchpad)
    {
        $sketchpad->delete();
        return response()->noContent(204);
    }
}
