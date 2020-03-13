<?foreach ($ev as $evaluation): ?>

  <div style="text-align: center; font-size: 24px; margin-top: 20px">
  <?= $evaluation->topico ?> (<?= $evaluation->fecha ?>)</div>

<?endforeach; ?>