<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Http\Requests\Training\StoreTrainingRequest;
use App\Http\Requests\Training\UpdateTrainingRequest;
use App\Models\Training;
use App\Models\TrainingPart;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Training::class);

        $user = $request->user();

        $trainings = Training::query()
            ->with(['trainingPart'])
            ->where(function ($query) use ($user) {
                return $query->where('user_id', null)
                    ->orWhere('user_id', $user->getkey());
            })
            ->get();

        return Inertia::render('Training/Index', [
            'trainings' => $trainings,
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('create', Training::class);

        $trainingPartId = $request->query('training_part_id');
        $trainingPart = TrainingPart::query()
            ->findOrNew($trainingPartId);

        return Inertia::render(('Training/Create'), [
            'trainingPart' => $trainingPart,
        ]);
    }

    public function store(StoreTrainingRequest $request)
    {
        $name = $request->validated()['name'];
        $partName = $request->validated()['part_name'];
        $enableTrainingPartStore = $request->validated()['enableTrainingPartStore'];
        $userId = $request->user()->getkey();

        DB::transaction(function () use ($name, $partName, $enableTrainingPartStore, $userId) {

            if ($enableTrainingPartStore) {

                $trainingPart = TrainingPart::create([
                    'name' => $partName,
                    'user_id' => $userId,
                ]);

                $training = Training::create([
                    'user_id' => $userId,
                    'training_part_id' => $trainingPart->getkey(),
                    'name' => $name,
                ]);

            } else {

                $trainingPart = TrainingPart::query()
                    ->where(function ($query) use ($userId) {
                        return $query->where('user_id', null)
                            ->orWhere('user_id', $userId);
                    })
                    ->where('name', $partName)
                    ->firstOrFail();

                $training = Training::create([
                    'user_id' => $userId,
                    'training_part_id' => $trainingPart->getkey(),
                    'name' => $name,
                ]);
            }

        });

        return redirect()->route('trainings.index');
    }

    public function edit(Request $request, Training $training)
    {
        $this->authorize('update', $training);

        $training->loadMissing([
            'trainingPart',
        ]);

        return Inertia::render(('Training/Edit'), [
            'training' => $training,
        ]);
    }

    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $name = $request->validated()['name'];
        $partName = $request->validated()['part_name'];
        $enableTrainingPartStore = $request->validated()['enableTrainingPartStore'];
        $userId = $request->user()->getkey();

        DB::transaction(function () use ($training, $name, $partName, $enableTrainingPartStore, $userId) {

            if ($enableTrainingPartStore) {

                $trainingPart = TrainingPart::create([
                    'name' => $partName,
                    'user_id' => $userId,
                ]);

                $training = $training->update([
                    'training_part_id' => $trainingPart->getkey(),
                    'name' => $name,
                ]);

            } else {

                $training = $training->update([
                    'name' => $name,
                ]);
            }

        });

        return redirect()->route('trainings.index');
    }

    public function destroy(Request $request, Training $training)
    {
        $this->authorize('delete', $training);

        DB::transaction(function () use ($training) {
            $training->delete();
        });

        return redirect()->route('trainings.index');
    }
}
